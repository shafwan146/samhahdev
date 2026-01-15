<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenStock;
use App\Models\GeneralConfig;
use App\Exports\ChickenStockExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ChickenStockController extends Controller
{
    public function index()
    {
        $stocks = ChickenStock::orderBy('product_type')
            ->orderBy('age_variant')
            ->paginate(15);
        
        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();
        
        return view('admin.stocks.create', compact('productTypes', 'ageVariants'));
    }

    public function store(Request $request)
    {
        $productTypeKeys = array_keys(GeneralConfig::getProductTypes());
        $ageVariantKeys = array_keys(GeneralConfig::getAgeVariants());

        $validated = $request->validate([
            'product_type' => ['required', 'string', Rule::in($productTypeKeys)],
            'age_variant' => ['required', 'string', Rule::in($ageVariantKeys)],
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        ChickenStock::create($validated);

        return redirect()
            ->route('admin.stocks.index')
            ->with('success', 'Stok berhasil ditambahkan.');
    }

    public function edit(ChickenStock $stock)
    {
        $productTypes = GeneralConfig::getProductTypes();
        $ageVariants = GeneralConfig::getAgeVariants();
        
        return view('admin.stocks.edit', compact('stock', 'productTypes', 'ageVariants'));
    }

    public function update(Request $request, ChickenStock $stock)
    {
        $productTypeKeys = array_keys(GeneralConfig::getProductTypes());
        $ageVariantKeys = array_keys(GeneralConfig::getAgeVariants());

        $validated = $request->validate([
            'product_type' => ['required', 'string', Rule::in($productTypeKeys)],
            'age_variant' => ['required', 'string', Rule::in($ageVariantKeys)],
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $stock->update($validated);

        return redirect()
            ->route('admin.stocks.index')
            ->with('success', 'Stok berhasil diperbarui.');
    }

    public function destroy(ChickenStock $stock)
    {
        $stock->delete();

        return redirect()
            ->route('admin.stocks.index')
            ->with('success', 'Stok berhasil dihapus.');
    }

    public function export()
    {
        $filename = 'stok_ayam_' . date('Y-m-d_His') . '.xlsx';
        
        return Excel::download(new ChickenStockExport, $filename);
    }
}
