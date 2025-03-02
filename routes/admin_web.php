<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Master\User\UserController;
use App\Http\Controllers\Admin\Transaction\ProductsTransactionController;
use App\Http\Controllers\Admin\Warehouse\WarehouseTransactionController;
use App\Http\Controllers\Admin\Wma\WeightedMovingAverageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::group(['middleware' => ['admin:web']], function () {
    Route::get('/view/file/{any}', function ($any) {
        return Storage::response('public/' . $any);
    })->where('any', '.*');
});

Route::prefix('administrator')->name('admin.')->group(function () {

    Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['admin:web']], function () {
        Route::prefix('dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => 'master', 'as' => 'master.', 'namespace' => 'Master'], function () {
            Route::prefix('users')->namespace('Users')->name('users.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/add', [UserController::class, 'add'])->name('add');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            });

        });

        Route::group(['prefix' => 'transaction', 'as' => 'transaction.', 'namespace' => 'Transaction'], function () {
            Route::prefix('products_transaction')->namespace('Product Transaction')->name('products_transaction.')->group(function () {
                Route::get('/acceptance', [ProductsTransactionController::class, 'acceptance'])->name('acceptance');
                Route::get('/transaction', [ProductsTransactionController::class, 'transaction'])->name('transaction');
                Route::get('/acceptance/add', [ProductsTransactionController::class, 'add_acceptance'])->name('add_acceptance');
                Route::get('/transaction/add', [ProductsTransactionController::class, 'add_transaction'])->name('add_transaction');
                Route::post('/store', [ProductsTransactionController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [ProductsTransactionController::class, 'edit'])->name('edit');
            });
        });

        Route::group(['prefix' => 'warehouse', 'as' => 'warehouse.', 'namespace' => 'Warehouse'], function () {
            Route::prefix('warehouse_transaction')->namespace('Warehouse Transaction')->name('warehouse_transaction.')->group(function () {
                Route::get('/', [WarehouseTransactionController::class,'index'])->name('index');
                Route::get('/get_product_by_category/{code}', [WarehouseTransactionController::class,'getProductByCategory'])->name('get_product_by_category');
                Route::post('/find_stock_product', [WarehouseTransactionController::class,'findStockProduct'])->name('find_stock_product');
                Route::post('/show_transaction_stock', [WarehouseTransactionController::class,'showTransactionStock'])->name('show_transaction_stock');
                Route::post('/get_detail_transaction_product', [WarehouseTransactionController::class,'getDetailTransactionProduct'])->name('get_detail_transaction_product');
                Route::post('/show_detail_transaction_product', [WarehouseTransactionController::class,'showDetailTransactionProduct'])->name('show_detail_transaction_product');
            });
        });

        Route::group(['prefix' => 'wma', 'as' => 'wma.', 'namespace' => 'Wma'], function () {
            Route::prefix('weighted_moving_average')->namespace('Weighted Moving Average')->name('weighted_moving_average.')->group(function () {
                Route::get('/', [WeightedMovingAverageController::class,'index'])->name('index');
                Route::post('/calculate_wma', [WeightedMovingAverageController::class,'calculateWma'])->name('calculate_wma');
                Route::post('/count_wma', [WeightedMovingAverageController::class,'countWma'])->name('count_wma');

            });
        });
    });
});
