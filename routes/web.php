<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

@include_once('admin_web.php');

Route::group(['prefix' => 'login','namespace' => 'App\Http\Controllers\Auth'], function(){
    Route::get('/', 'LoginController@index')->name('index');
    Route::post('/', 'LoginController@login')->name('login');
});

Route::get('/', function () {
    return redirect()->route('index');
})->name('/');
