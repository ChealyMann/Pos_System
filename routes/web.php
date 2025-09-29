<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\ReportController;


// Route::get('/', function () {
//     return view('index');
// });

Route::resource('/', HomeController::class);
Route::resource('/cash', CashController::class);
Route::resource('/user', UserController::class);
Route::resource('/supplier', SupplierController::class);
Route::resource('/product', ProductController::class);
Route::resource('/purchase', PurchaseController::class);
Route::resource('/category', CategorieController::class);
Route::resource('/role', RoleController::class);
Route::resource('/sale', SaleController::class);
//Route::resource('/stock', StockController::class);
Route::resource('/stock_in', StockInController::class);
//Route::resource('/report', ReportController::class);

// Handle Add Stock form submission
Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::post('/store', [StockController::class, 'store'])->name('store');
});

Route::controller(ReportController::class)->group(function () {
    Route::get('report/stock', 'stock')->name('report.stock');
    Route::get('report/sale', 'sale')->name('report.sale');
    Route::get('report/purchase', 'purchase')->name('report.purchase');
});

