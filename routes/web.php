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

Route::prefix('role')->name('role.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\RoleController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\RoleController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\RoleController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\RoleController::class, 'update'])->name('update');
});


Route::prefix('user')->name('user.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\UserController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\UserController::class, 'update'])->name('update');
});



Route::prefix('category')->name('category.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\CategoryController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\CategoryController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\CategoryController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\CategoryController::class, 'update'])->name('update');
});


Route::prefix('brand')->name('brand.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\BrandController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\BrandController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\BrandController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\BrandController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\BrandController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\BrandController::class, 'update'])->name('update');
});


Route::prefix('version')->name('version.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\VersionController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\VersionController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\VersionController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\VersionController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\VersionController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\VersionController::class, 'update'])->name('update');
});

Route::prefix('bank')->name('bank.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\BankController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\BankController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\BankController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\BankController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\BankController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\BankController::class, 'update'])->name('update');
});

Route::prefix('safe')->name('safe.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\SafeController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\SafeController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\SafeController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\SafeController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\SafeController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\SafeController::class, 'update'])->name('update');
});

Route::prefix('customer')->name('customer.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\CustomerController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\CustomerController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\CustomerController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\CustomerController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\CustomerController::class, 'update'])->name('update');
    Route::post('updateDanger', [App\Http\Controllers\CustomerController::class, 'updateDanger'])->name('updateDanger');
});
