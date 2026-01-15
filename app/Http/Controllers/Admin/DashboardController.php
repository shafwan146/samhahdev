<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChickenStock;
use App\Models\Transaction;

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

        // Get monthly sales data for chart
        $currentYear = now()->year;
        $monthlySales = Transaction::getMonthlySales($currentYear);

        // Calculate total transactions stats
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_price');
        $thisMonthSales = Transaction::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('quantity');

        return view('admin.dashboard', compact(
            'totalStock',
            'totalProducts',
            'stockByType',
            'recentStocks',
            'monthlySales',
            'totalTransactions',
            'totalRevenue',
            'thisMonthSales',
            'currentYear'
        ));
    }
}
