<?php

    use App\Http\Controllers\CashController;
    use App\Http\Controllers\CategorieController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\PurchaseController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\SaleController;
    use App\Http\Controllers\StockController;
    use App\Http\Controllers\StockInController;
    use App\Http\Controllers\SupplierController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('login.index');
    })->name('login');

// Handle login form submission
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

// Handle logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'admin'])->group(function () {

        // Dashboard
        Route::resource('/', HomeController::class);

        // Resource Controllers
        Route::resource('/user', UserController::class);
        Route::resource('/supplier', SupplierController::class);
        Route::resource('/product', ProductController::class);
        Route::resource('/purchase', PurchaseController::class);
        Route::resource('/category', CategorieController::class);
        Route::resource('/stock_in', StockInController::class);

        // Stock Routes
        Route::prefix('stock')->name('stock.')->group(function () {
            Route::get('/', [StockController::class, 'index'])->name('index');
            Route::post('/store', [StockController::class, 'store'])->name('store');
        });

        // Role Routes
        Route::controller(RoleController::class)->group(function () {
            Route::get('role/', 'index')->name('role.index');
            Route::post('role/store', 'store')->name('role.store');
            Route::put('role/update/{id}', 'update')->name('role.update');
            Route::delete('role/delete/{id}', 'destroy')->name('role.destroy');
        });

        // Report Routes
        Route::controller(ReportController::class)->group(function () {
            Route::get('report/stock', 'stock')->name('report.stock');
            Route::get('report/sale', 'sale')->name('report.sale');
            Route::get('report/purchase', 'purchase')->name('report.purchase');
            Route::get('report/financial', 'financial')->name('report.financial');
            Route::post('report/filter', 'filter')->name('report.filter');

            // Sale Report Detail Routes
            Route::post('report/sale/generate', 'generateSaleReport')->name('report.generateSaleReport');
            Route::get('report/sale/{id}', 'saleDetail')->name('report.saleDetail');

            // Stock Report Detail Routes
            Route::post('report/stock/generate', 'generateStockReport')->name('report.generateStockReport');
            Route::get('report/stock/{id}', 'stockDetail')->name('report.stockDetail');
        });

        // Sale Reports Resource (Note: SaleReportController is referenced but not imported)
        Route::prefix('sale-reports')->name('sale_reports.')->group(function () {
            Route::get('/', [SaleReportController::class, 'index'])->name('index');
            Route::post('/', [SaleReportController::class, 'store'])->name('store');
            Route::get('/{id}', [SaleReportController::class, 'show'])->name('show');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Cashier Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'cashier'])->group(function () {
        Route::resource('/home', HomeController::class)->names('home');
        Route::resource('/cash', CashController::class);
        Route::resource('/sale', SaleController::class);
    });
