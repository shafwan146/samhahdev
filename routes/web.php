<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ChickenStockController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralConfigController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    // Auth Routes (Guest Only)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AuthController::class, 'login']);
    });

    // Protected Routes
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('stocks/export', [ChickenStockController::class, 'export'])->name('admin.stocks.export');
        Route::resource('stocks', ChickenStockController::class)->names('admin.stocks');
        Route::resource('configs', GeneralConfigController::class)->names('admin.configs')->except(['show']);
    });
});
