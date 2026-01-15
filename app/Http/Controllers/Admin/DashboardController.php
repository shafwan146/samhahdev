<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenStock;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStock = ChickenStock::sum('quantity');
        $totalProducts = ChickenStock::count();
        $stockByType = ChickenStock::selectRaw('product_type, SUM(quantity) as total')
            ->groupBy('product_type')
            ->get();
        
        $recentStocks = ChickenStock::orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStock',
            'totalProducts',
            'stockByType',
            'recentStocks'
        ));
    }
}
