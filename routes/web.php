<?php

    use App\Http\Controllers\LoginController;
    use Illuminate\Support\Facades\Auth;
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
//
Route::middleware('auth')->group(function () {

Route::resource('/', HomeController::class);
Route::resource('/cash', CashController::class);
Route::resource('/user', UserController::class);
Route::resource('/supplier', SupplierController::class);
Route::resource('/product', ProductController::class);
Route::resource('/purchase', PurchaseController::class);
Route::resource('/category', CategorieController::class);
// Route::resource('/role', RoleController::class);
Route::resource('/sale', SaleController::class);
//Route::resource('/stock', StockController::class);
Route::resource('/stock_in', StockInController::class);
//Route::resource('/report', ReportController::class);

Route::prefix('stock')->name('stock.')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::post('/store', [StockController::class, 'store'])->name('store');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('role/', 'index')->name('role.index');
    Route::post('role/store', 'store')->name('role.store');
    Route::put('role/update/{id}', 'update')->name('role.update');
    Route::delete('role/delete/{id}', 'destroy')->name('role.destroy');
});

Route::controller(ReportController::class)->group(function () {
    Route::get('report/stock', 'stock')->name('report.stock');
    Route::get('report/sale', 'sale')->name('report.sale');
    Route::get('report/purchase', 'purchase')->name('report.purchase');
    Route::get('report/financial', 'financial')->name('report.financial');
    Route::post('report/filter', 'filter')->name('report.filter');
});

Route::resource('/home', HomeController::class)->names('home');

});


Route::get('/', function () {
        if(Auth::check()){
            return redirect('/home');
        }
        return view('login.index');
    })->name('login');
Route::post('login', LoginController::class)->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



/* Detailed Report Routes */
Route::get('/report/sale', [ReportController::class, 'sale'])->name('report.sale');
Route::post('/report/sale/generate', [ReportController::class, 'generateSaleReport'])->name('report.generateSaleReport');
Route::get('/report/sale/{id}', [ReportController::class, 'saleDetail'])->name('report.saleDetail');

/* Sale Report Routes */
Route::get('/sale-reports', [SaleReportController::class, 'index'])->name('sale_reports.index');
Route::post('/sale-reports', [SaleReportController::class, 'store'])->name('sale_reports.store');
Route::get('/sale-reports/{id}', [SaleReportController::class, 'show'])->name('sale_reports.show');

/* Stock Report Routes */
Route::get('/report/stock', [ReportController::class, 'stock'])->name('report.stock');
Route::post('/report/stock/generate', [ReportController::class, 'generateStockReport'])->name('report.generateStockReport');
Route::get('/report/stock/{id}', [ReportController::class, 'stockDetail'])->name('report.stockDetail');
