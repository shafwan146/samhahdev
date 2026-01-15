<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\GeneralConfig;
use App\Exports\TransactionExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
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

        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();
        $transactionCode = Transaction::generateCode();
        
        return view('admin.transactions.create', compact('productTypes', 'ageVariants', 'transactionCode'));
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

        Transaction::create($validated);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();
        
        return view('admin.transactions.edit', compact('transaction', 'productTypes', 'ageVariants'));
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

        $transaction->update($validated);

        return redirect()
            ->route('admin.transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
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
