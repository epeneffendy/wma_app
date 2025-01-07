<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Master\User\UserController;
use App\Http\Controllers\Admin\Transaction\ProductsTransactionController;
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
    });
});
