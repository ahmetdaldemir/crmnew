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


Route::prefix('color')->name('color.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\ColorController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\ColorController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\ColorController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\ColorController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\ColorController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\ColorController::class, 'update'])->name('update');
});


Route::prefix('warehouse')->name('warehouse.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\WarehouseController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\WarehouseController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\WarehouseController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\WarehouseController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\WarehouseController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\WarehouseController::class, 'update'])->name('update');
});


Route::prefix('stockcard')->name('stockcard.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\StockCardController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\StockCardController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\StockCardController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\StockCardController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\StockCardController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\StockCardController::class, 'update'])->name('update');
    Route::get('movement', [App\Http\Controllers\StockCardController::class, 'movement'])->name('movement');
    Route::post('add_movement', [App\Http\Controllers\StockCardController::class, 'add_movement'])->name('add_movement');
    Route::get('showmovemnet', [App\Http\Controllers\StockCardController::class, 'showmovemnet'])->name('showmovemnet');
    Route::post('sevk', [App\Http\Controllers\StockCardController::class, 'sevk'])->name('sevk');
});

Route::prefix('transfer')->name('transfer.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\TransferController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\TransferController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\TransferController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\TransferController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\TransferController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\TransferController::class, 'update'])->name('update');
    Route::get('show', [App\Http\Controllers\TransferController::class, 'show'])->name('show');
});

Route::prefix('reason')->name('reason.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\ReasonController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\ReasonController::class, 'edit'])->name('edit');
    Route::get('delete', [App\Http\Controllers\ReasonController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\ReasonController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\ReasonController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\ReasonController::class, 'update'])->name('update');
});

Route::prefix('invoice')->name('invoice.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\InvoiceController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\InvoiceController::class, 'edit'])->name('edit');
    Route::get('show', [App\Http\Controllers\InvoiceController::class, 'show'])->name('show');
    Route::get('delete', [App\Http\Controllers\InvoiceController::class, 'delete'])->name('delete');
    Route::get('create', [App\Http\Controllers\InvoiceController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\InvoiceController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\InvoiceController::class, 'update'])->name('update');
    Route::get('einvoice', [App\Http\Controllers\InvoiceController::class, 'einvoice'])->name('einvoice');
});

Route::prefix('e_invoice')->name('e_invoice.')->middleware([])->group(function () {
    Route::get('/', [App\Http\Controllers\EInvoiceController::class, 'index'])->name('index');
    Route::get('edit', [App\Http\Controllers\EInvoiceController::class, 'edit'])->name('edit');
    Route::get('show', [App\Http\Controllers\EInvoiceController::class, 'show'])->name('show');
    Route::get('delete', [App\Http\Controllers\EInvoiceController::class, 'delete'])->name('delete');
    Route::post('create', [App\Http\Controllers\EInvoiceController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\EInvoiceController::class, 'store'])->name('store');
    Route::post('update', [App\Http\Controllers\EInvoiceController::class, 'update'])->name('update');
    Route::get('e_invoice_create', [App\Http\Controllers\EInvoiceController::class, 'e_invoice_create'])->name('e_invoice_create');
});

/**  Custom **/

Route::get('/get_cities', [App\Http\Controllers\CustomController::class, 'get_cities'])->name('get_cities');
Route::post('/custom_customerstore', [App\Http\Controllers\CustomController::class, 'customerstore'])->name('custom_customerstore');
Route::post('/custom_customerget', [App\Http\Controllers\CustomController::class, 'customerget'])->name('custom_customerget');
