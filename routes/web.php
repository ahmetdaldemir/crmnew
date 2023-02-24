<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('seller')->name('seller.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\SellerController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\SellerController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\SellerController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\SellerController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\SellerController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\SellerController::class, 'update'])->name('update');
});


Route::prefix('company')->name('company.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\CompanyController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\CompanyController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\CompanyController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\CompanyController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\CompanyController::class, 'update'])->name('update');
});

Route::prefix('user')->name('user.')->middleware([])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });
});
