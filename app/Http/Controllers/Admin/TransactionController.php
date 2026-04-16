<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\GeneralConfig;
use App\Exports\TransactionExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\ChickenStock;

class TransactionController extends Controller
{
    /**
     * Helper to adjust stock quantity automatically.
     * $quantityChange can be negative (for sales/deduction) or positive (for reverting/cancellation).
     */
    private function adjustStock($productType, $ageVariant, $quantityChange)
    {
        if ($quantityChange == 0) return;

        // Cari stok dengan tipe dan varian umur yang sama
        $stock = ChickenStock::where('product_type', $productType)
            ->where('age_variant', $ageVariant)
            ->orderBy('id', 'asc') // Utamakan stok yang paling lama dibuat (FIFO simple)
            ->first();

        if ($stock) {
            $stock->quantity += $quantityChange;
            $stock->save();
        } else {
            // Jika belum ada stok sama sekali tapi ada transaksi
            ChickenStock::create([
                'product_type' => $productType,
                'age_variant' => $ageVariant,
                'product_name' => GeneralConfig::getProductTypeLabel($productType) ?? 'Produk Baru',
                'quantity' => $quantityChange,
                'price' => 0,
            ]);
        }
    }

    public function index(Request $request)
    {
        $query = Transaction::orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc');

        // Filter by month if provided
        if ($request->filled('month') && $request->filled('year')) {
            $query->ofMonth($request->month, $request->year);
        } elseif ($request->filled('year')) {
            $query->ofYear($request->year);
        }

        $transactions = $query->paginate(15)->withQueryString();
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();

        return view('admin.transactions.index', compact('transactions', 'productTypes', 'ageVariants'));
    }

    public function create()
    {
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();
        $transactionCode = Transaction::generateCode();
        
        $stocks = ChickenStock::selectRaw('product_type, age_variant, SUM(quantity) as total_quantity')
            ->groupBy('product_type', 'age_variant')
            ->get();
            
        $availableStocks = [];
        foreach ($stocks as $stock) {
            if ($stock->total_quantity > 0) {
                if (!isset($availableStocks[$stock->product_type])) {
                    $availableStocks[$stock->product_type] = [];
                }
                $availableStocks[$stock->product_type][$stock->age_variant] = $stock->total_quantity;
            }
        }
        
        return view('admin.transactions.create', compact('productTypes', 'ageVariants', 'transactionCode', 'availableStocks'));
    }

    public function store(Request $request)
    {
        $productTypeKeys = array_keys(GeneralConfig::getProductTypes());
        $ageVariantKeys = array_keys(GeneralConfig::getAgeVariants());

        $validated = $request->validate([
            'transaction_code' => 'required|string|unique:transactions,transaction_code',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'product_type' => ['required', 'string', Rule::in($productTypeKeys)],
            'age_variant' => ['required', 'string', Rule::in($ageVariantKeys)],
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['total_price'] = $validated['quantity'] * $validated['unit_price'];

        // Cek apakah stok mencukupi
        $totalStock = ChickenStock::where('product_type', $validated['product_type'])
            ->where('age_variant', $validated['age_variant'])
            ->sum('quantity');

        if ($totalStock < $validated['quantity']) {
            return back()->withInput()->withErrors(['quantity' => 'Stok tidak mencukupi. Sisa stok: ' . $totalStock]);
        }

        // Kurangi stok barang
        $this->adjustStock($validated['product_type'], $validated['age_variant'], -$validated['quantity']);

        Transaction::create($validated);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();
        
        $stocks = ChickenStock::selectRaw('product_type, age_variant, SUM(quantity) as total_quantity')
            ->groupBy('product_type', 'age_variant')
            ->get();
            
        $availableStocks = [];
        foreach ($stocks as $stock) {
            $qty = $stock->total_quantity;
            // Tambahkan kuantitas dari transaksi saat ini agar bisa dipilih ulang tanpa validasi error
            if ($transaction->product_type === $stock->product_type && $transaction->age_variant === $stock->age_variant) {
                $qty += $transaction->quantity;
            }
            if ($qty > 0) {
                if (!isset($availableStocks[$stock->product_type])) {
                    $availableStocks[$stock->product_type] = [];
                }
                $availableStocks[$stock->product_type][$stock->age_variant] = $qty;
            }
        }
        
        // Jika tidak ada di stok sama sekali, tapi ada di transaksi ini (misal stok awal memang 0 tanpa transaksi lain)
        if (!isset($availableStocks[$transaction->product_type][$transaction->age_variant])) {
            $availableStocks[$transaction->product_type][$transaction->age_variant] = $transaction->quantity;
        }
        
        return view('admin.transactions.edit', compact('transaction', 'productTypes', 'ageVariants', 'availableStocks'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $productTypeKeys = array_keys(GeneralConfig::getProductTypes());
        $ageVariantKeys = array_keys(GeneralConfig::getAgeVariants());

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'product_type' => ['required', 'string', Rule::in($productTypeKeys)],
            'age_variant' => ['required', 'string', Rule::in($ageVariantKeys)],
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['total_price'] = $validated['quantity'] * $validated['unit_price'];

        // Cek apakah stok baru mencukupi
        $totalStock = ChickenStock::where('product_type', $validated['product_type'])
            ->where('age_variant', $validated['age_variant'])
            ->sum('quantity');

        $availableStock = $totalStock;
        // Jika produk dan umur sama dengan transaksi sebelumnya, berarti stok yang dipakai sebelumnya akan dikembalikan terlebih dahulu
        if ($transaction->product_type === $validated['product_type'] && $transaction->age_variant === $validated['age_variant']) {
            $availableStock += $transaction->quantity;
        }

        if ($availableStock < $validated['quantity']) {
            return back()->withInput()->withErrors(['quantity' => 'Stok tidak mencukupi. Sisa stok yang bisa digunakan: ' . $availableStock]);
        }

        // Kembalikan stok lama
        $this->adjustStock($transaction->product_type, $transaction->age_variant, $transaction->quantity);
        
        // Kurangi stok baru
        $this->adjustStock($validated['product_type'], $validated['age_variant'], -$validated['quantity']);

        $transaction->update($validated);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        // Kembalikan stok yang dihapus
        $this->adjustStock($transaction->product_type, $transaction->age_variant, $transaction->quantity);

        $transaction->delete();

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function export()
    {
        $filename = 'transaksi_' . date('Y-m-d_His') . '.xlsx';
        
        return Excel::download(new TransactionExport, $filename);
    }
}
