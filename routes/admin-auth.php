<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\PurchasesController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredAdminController::class, 'store']);

    Route::get('/', [AdminLoginController::class, 'create'])
        ->name('login');

    Route::post('/', [AdminLoginController::class, 'store']);
});

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin/')->group(function () {
    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout'); 
});

Route::prefix('admin')->controller(DashboardController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('dashboard','Dashboard')->name('dashboard');
    Route::get('get-stock-levels/{item_id}','getStockLevels')->name('get-stock-levels');
    Route::get('get-no-of-items/{category_id}','getNoOfItems')->name('get-no-of-items');
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
    Route::get('destroy-transactions/{inventory_tracking_id}','destroy')->name('destroy-transactions');
});

Route::prefix('admin')->controller(PurchasesController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('purchases','index')->name('purchases');
    Route::post('store-purchases','store')->name('store-purchases');
    Route::post('update-purchases/{purchase_id}','update')->name('update-purchases');
    Route::get('get-purchase-details/{purchase_id}','getPurchaseDetails')->name('get-purchase-details');
    Route::get('fulfill-purchase/{purchase_id}','fulfill')->name('fulfill-purchase');
    Route::get('destroy-purchase/{purchase_id}','destroy')->name('destroy-purchase');
});

Route::prefix('admin')->controller(SalesController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('sales','index')->name('sales');
    Route::post('store-sales','store')->name('store-sales');
    Route::post('update-sales/{sale_id}','update')->name('update-sales');
    Route::get('getItemDetails','getItemDetails')->name('getItemDetails');
    Route::get('get-sale-details/{sale_id}','getSaleDetails')->name('get-sale-details');
    Route::get('confirm-sale/{sale_id}','confirm')->name('confirm-sale');
    Route::get('destroy-sale/{sale_id}','destroy')->name('destroy-sale');
});

Route::prefix('admin')->controller(BatchController::class,)->middleware(['auth','verified'])->name('admin/')->group(function(){
    Route::get('batch','index')->name('batch');
});


// Dashboard Apexchart Data Fetch Code

Route::get('/api/category-sales-restocks', function () {
    $data = DB::table('categories')
        ->join('items', 'categories.category_id', '=', 'items.category_id')
        ->leftJoin('sales', 'items.items_id', '=', 'sales.item_id')
        ->leftJoin('purchases', 'items.items_id', '=', 'purchases.item_id')
        ->select(
            'categories.category as category',
            DB::raw('SUM(sales.quantity) as sales'),
            DB::raw('SUM(purchases.quantity) as restocks')
        )
        ->groupBy('categories.category_id', 'categories.category')
        ->get();

    return response()->json($data);
});
