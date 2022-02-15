<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);



Route::group(['middleware' => ['prevent-back-history']], function() {

    Auth::routes();

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
        Route::resource('forms', AdminController::class);
    });

});
