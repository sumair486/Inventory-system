<?php

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WarehouseController;
use App\Models\Transaction;

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

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();


  
Route::group(['middleware' => ['auth']], function() {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\UserController::class, 'dashboard']);


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('products', ProductController::class);

    Route::get('brand',[SettingController::class,'index'])->name('brand.create');
    Route::post('brand',[SettingController::class,'store'])->name('brand.store');
    Route::get('brand-show',[SettingController::class,'show'])->name('brand.show');
    Route::delete('delete-brand/{brand}',[SettingController::class,'destroy'])->name('brand.delete');

    Route::get('category',[SettingController::class,'category_index'])->name('category.create');
    Route::post('category',[SettingController::class,'category_store'])->name('category.store');
    Route::get('category-show',[SettingController::class,'category_show'])->name('category.show');
    Route::delete('delete-category/{category}',[SettingController::class,'category_destroy'])->name('category.delete');

    Route::get('company',[SettingController::class,'company_index'])->name('company.create');
    Route::post('company',[SettingController::class,'company_store'])->name('company.store');
    Route::get('company-show',[SettingController::class,'company_show'])->name('company.show');
    Route::delete('delete-company/{company}',[SettingController::class,'company_destroy'])->name('company.delete');

    Route::get('border',[SettingController::class,'border_index'])->name('border.create');
    Route::post('border',[SettingController::class,'border_store'])->name('border.store');
    Route::get('border-show',[SettingController::class,'border_show'])->name('border.show');
    Route::delete('delete-border/{border}',[SettingController::class,'border_destroy'])->name('border.delete');


    Route::get('transaction',[TransactionController::class,'create'])->name('transaction.create');
    Route::post('transaction',[TransactionController::class,'store'])->name('transaction.store');
    Route::get('transaction-show',[TransactionController::class,'show'])->name('transaction.show');
    Route::delete('transaction-delete/{transaction}',[TransactionController::class,'destroy'])->name('transaction.delete');
    Route::get('transaction-edit/{id}',[TransactionController::class,'edit'])->name('transaction.edit');
    Route::post('transaction-update/{id}',[TransactionController::class,'update'])->name('transaction.update');

    
    // Route::get('/get-commission-date/{commissionId}', 'TransactionController@getCommissionDate');
  

    Route::get('/get-commission-quantity/{commissionAgentId}', [TransactionController::class, 'getCommissionQuantity']);


    Route::get('transaction-add/{transaction}',[TransactionController::class,'transaction_add'])->name('transaction.add');
    Route::post('transaction-add/{transaction}',[TransactionController::class,'transaction_save'])->name('transaction.save');

    Route::get('transfer',[TransferController::class,'create'])->name('transfer.create');
    Route::post('transfer',[TransferController::class,'store'])->name('transfer.store');
    Route::get('transfer-show',[TransferController::class,'show'])->name('transfer.show');
    Route::get('transfer-detail/{id}',[TransferController::class,'detail'])->name('transfer.detail');

    Route::delete('transfer-delete/{transfer}',[TransferController::class,'destroy'])->name('transfer.delete');
    Route::get('transfer-edit',[TransferController::class,'edit'])->name('transfer.edit');

    Route::get('/get-transaction-data/{commissionAgent}', [TransferController::class, 'getTransactionData']);
    // Route::get('/get-commission-product/{productAgent}', [TransferController::class, 'getTransactionProduct']);
    // Route::get('/get-product-id/{transactionId}', [TransferController::class, 'getProductId']);
    Route::get('/get-product-data/{transactionId}', [TransferController::class, 'getProductData']);





    // Route::get('/get-commission-date/{commissionId}', 'TransactionController@getCommissionDate');



    //commission

    Route::get('commission',[CommissionController::class,'create'])->name('commission.create');
    Route::get('commission-active/{id}',[CommissionController::class,'active_status'])->name('commission.active');
    Route::get('commission-inactive/{id}',[CommissionController::class,'inactive_status'])->name('commission.inactive');


    Route::post('commission',[CommissionController::class,'store'])->name('commission.store');
    Route::get('commission-show',[CommissionController::class,'show'])->name('commission.show');
    Route::delete('commission-delete/{commission}',[CommissionController::class,'destroy'])->name('commission.delete');

     //commission ledger

     Route::get('commission_ledger',[CommissionController::class,'ledger_create'])->name('commission_ledger.create');
     Route::post('commission_ledger',[CommissionController::class,'ledger_store'])->name('commission_ledger.store');
     Route::get('commission_ledger-show',[CommissionController::class,'ledger_show'])->name('commission_ledger.show');
     Route::delete('commission_ledger-delete/{commission_ledger}',[CommissionController::class,'ledger_destroy'])->name('commission_ledger.delete');

    Route::get('sale',[SettingController::class,'sale_index'])->name('sale.create');


    //warehouse

    Route::get('warehouse',[WarehouseController::class,'index'])->name('warehouse.create');
    Route::post('warehouse',[WarehouseController::class,'store'])->name('warehouse.store');
    Route::get('warehouse-show',[WarehouseController::class,'show'])->name('warehouse.show');
    Route::delete('delete-warehouse/{warehouse}',[WarehouseController::class,'destroy'])->name('warehouse.delete');

    Route::get('warehouse-stock',[WarehouseController::class,'warehouse_stock'])->name('warehouse-stock.show');
    Route::delete('warehouse-stock/{stock}',[WarehouseController::class,'warehouse_destroy'])->name('warehouse-stock.delete');



//customer

Route::get('customer',[CustomerController::class,'index'])->name('customer.create');
    Route::post('customer',[CustomerController::class,'store'])->name('customer.store');
    Route::get('customer-show',[CustomerController::class,'show'])->name('customer.show');
    Route::delete('delete-customer/{customer}',[CustomerController::class,'destroy'])->name('customer.delete');


    //sale


    Route::get('sale',[SaleController::class,'index'])->name('sale.create');
    Route::post('sale',[SaleController::class,'store'])->name('sale.store');
    Route::get('sale-show',[SaleController::class,'show'])->name('sale.show');
    Route::delete('delete-sale/{sale}',[SaleController::class,'destroy'])->name('sale.delete');


    // get sale function


    // Route::get('/get-warehouse-data/{warehouseId}', [SaleController::class, 'getwarehousedata']);

    Route::get('/get-warehouse-data/{warehouseId}', [SaleController::class, 'getWarehouseData']);
    
//reports

Route::get('/all-report', [ReportController::class, 'generateCombinedReport'])->name('report.all');

    Route::get('/border-stock-report', [ReportController::class, 'border_stock_report'])->name('report.border.stock');
    Route::get('/border-stock-detail-report', [ReportController::class, 'border_stock_detail_report'])->name('report.border.stock.detail');
  
    Route::get('/loader-report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/transfer-report', [ReportController::class, 'transfer_report'])->name('report.transfer');
    Route::get('/stock-report', [ReportController::class, 'stock_report'])->name('report.stock');
    Route::get('/sale-report', [ReportController::class, 'sale_report'])->name('report.sale');


    Route::get('/delivery-ledger-report', [ReportController::class, 'delivery_report'])->name('report.delivery');

    

    //border transaction

    Route::get('/border-transaction', [SettingController::class, 'border_transaction'])->name('border.transaction');

    Route::post('/border-transaction', [SettingController::class, 'border_transaction_store'])->name('border.transaction.store');
    Route::get('/border-transaction-show', [SettingController::class, 'border_transaction_show'])->name('border.transaction.show');
    Route::delete('/border-transaction-show/{bordertransaction}', [SettingController::class, 'border_transaction_destroy'])->name('border.transaction.delete');
// border.detail.edit
    // detail 
    Route::get('/border-detail-show', [SettingController::class, 'border_detail_show'])->name('border.detail.show');
    Route::delete('/border-detail-show/{borderdetail}', [SettingController::class, 'border_detail_destroy'])->name('border.detail.delete');
//edit border detail
    // Route::get('/border.detail.edit/{id}', [SettingController::class, 'border_detail_edit'])->name('border.detail.edit');
    Route::get('/border-transaction-edit/{id}', [SettingController::class, 'border_transaction_edit'])->name('border.transaction.edit');
    Route::post('/border-transaction-update/{id}', [SettingController::class, 'border_transaction_update'])->name('border.transaction.update');

// example
Route::get('/border-transaction/{id}/edit', [SettingController::class, 'border_transaction_edit'])->name('border.transaction.edit');
Route::put('/border-transaction/{id}', [SettingController::class, 'border_transaction_update'])->name('border.transaction.update');


// Route::get('', 'SettingController@border_transaction_edit')->name('border.transaction.edit');
// Route::put('/border-transaction/{id}', 'SettingController@border_transaction_update')->name('border.transaction.update');


//
    // boder stock

Route::get('/border-stock-show', [SettingController::class, 'border_stock_show'])->name('border.stock.show');

Route::delete('/border-stock-show/{borderstock}', [SettingController::class, 'border_stock_destroy'])->name('border.stock.delete');

// border

Route::get('/border-warehouse', [SettingController::class, 'border_warehouse'])->name('border.warehouse');
Route::get('/border-warehouse-show', [SettingController::class, 'border_warehouse_show'])->name('border.warehouse.show');

Route::post('/border-warehouse', [SettingController::class, 'border_warehouse_store'])->name('border.warehouse.store');

Route::delete('border-warehous/{borderwarehouse}',[SettingController::class,'border_warehouse_destroy'])->name('border.warehouse.destroy');

Route::get('/combine-report', [ReportController::class, 'combineReport'])->name('border.combine.report');

//

Route::get('getProducts',[TransferController::class,'getProducts']);

// border transaction category agauinst

// Route::get('/get-products-by-category/{category_id}', 'ProductController@getProductsByCategory');
// Route::get('/', 'BorderDetailController@getProductByCategory');

Route::get('/get-product-by-category', [SettingController::class, 'getProductByCategory']);


// click specific product
Route::get('getborder',[UserController::class,'getborder'])->name('getborder');

Route::get('border-product/{id}',[UserController::class,'getborderproduct'])->name('border.product');


//border stock click
Route::get('getwarehouse',[UserController::class,'getwarestock'])->name('getwarehouse');
Route::get('getwarehouse-product/{id}',[UserController::class,'getwarestockproduct'])->name('getwarehouseproduct');


//edit transfer

Route::get('/transfers/{id}/edit',[TransferController::class,'transfer_edit'])->name('transfer.edit');
Route::post('/transfers-update/{id}',[TransferController::class,'transfer_update'])->name('transfer.update');


// Route::get('/transfers/{id}/edit', 'TransferController@edit')->name('transfer.edit');



});
