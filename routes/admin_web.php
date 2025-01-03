<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Master\User\UserController;
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
    });
});
