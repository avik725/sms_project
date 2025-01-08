<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\PurchasesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('/', [AdminLoginController::class, 'create'])
        ->name('login');

    Route::post('/', [AdminLoginController::class, 'store']);
});

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin/')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard'); 
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout'); 
});

Route::prefix('admin')->controller(SettingsController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('settings','Settings')->name('settings');
    Route::post('settings-update/{settings_id}','update')->name('settings-update');
});

Route::prefix('admin')->controller(SuppliersController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('suppliers','Suppliers')->name('suppliers');
    Route::get('supplier-data/{suppliers_id}', 'getSupplierData')->name('supplier-data');
    Route::post('store-suppliers','store')->name('store-suppliers');
    Route::post('edit-suppliers/{suppliers_id}','update')->name('edit-suppliers');
    Route::get('delete-suppliers/{suppliers_id}','destroy')->name('delete-suppliers');
});

Route::prefix('admin')->controller(CategoriesController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('categories','index')->name('categories');
    Route::post('store-categories','storeCategory')->name('store-categories');
    Route::post('store-subcategories','storeSubcategory')->name('store-subcategories');
    Route::get('destroy-categories/{category_id}','destroyCategory')->name('destroy-categories');
    Route::get('destroy-subcategories/{subcategory_id}','destroySubcategory')->name('destroy-subcategories');
});

Route::prefix('admin')->controller(ItemsController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('items','index')->name('items');
    Route::post('store-items','store')->name('store-items');
    Route::get('getsubcategories-items','getSubcategories')->name('getsubcategories-items');
    Route::post('update-items/{items_id}','update')->name('update-items');
    Route::get('get-items/{items_id}','getItem')->name('get-items');
    Route::get('get-units','getUnits')->name('get-units');
    Route::get('get-edit-units','getEditUnits')->name('get-edit-units');
    Route::get('destroy-items/{items_id}','destroy')->name('destroy-items');
});

Route::prefix('admin')->controller(InventoryController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('transactions','index')->name('transactions');
    Route::post('transactions-store','store')->name('transactions-store');
    Route::get('destroy-transactions','destroy')->name('destroy-transactions');
});

Route::prefix('admin')->controller(PurchasesController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('purchases','index')->name('purchases');
    Route::post('store-purchases','store')->name('store-purchases');
    Route::get('fulfill-purchase/{purchases_id}','fulfill')->name('fulfill-purchase');
    Route::get('destroy-purchase/{purchases_id}','destroy')->name('destroy-purchase');
});