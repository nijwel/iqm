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

Route::get( '/', function () {
    return redirect()->route( 'login' );
} );

Route::view( 'home', 'home' )->middleware( 'auth' );

Route::group( ['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'auth'], function () {

    //----Admin Route----//
    Route::group( ['prefix' => 'admin'], function () {
        Route::get( '/', 'UserController@index' )->name( 'index.admin' );
        Route::get( 'create', 'UserController@create' )->name( 'admin.create' );
        Route::post( 'store', 'UserController@store' )->name( 'store.admin' );
        Route::get( 'edit/{id}', 'UserController@edit' )->name( 'edit.admin' );
        Route::get( 'delete/{id}', 'UserController@destroy' )->name( 'delete.admin' );
        Route::post( 'update/{id}', 'UserController@update' )->name( 'update.admin' );

        Route::get( 'profile', 'AdminController@profile' )->name( 'profile' );
        Route::post( 'update/info/{id}', 'AdminController@updateInfo' )->name( 'update.user.info' );
        Route::get( 'change/password', 'AdminController@password' )->name( 'password' );
        Route::post( 'update/admin/password', 'AdminController@passwordUpdate' )->name( 'update.password' );
    } );

    //----Category Route----//
    Route::group( ['prefix' => 'category'], function () {
        Route::get( '/', 'CategoryController@index' )->name( 'index.category' );
        Route::post( 'store', 'CategoryController@store' )->name( 'store.category' );
        Route::get( 'edit/{id}', 'CategoryController@edit' )->name( 'edit.category' );
        Route::post( 'update/{id}', 'CategoryController@update' )->name( 'update.category' );
        Route::get( 'delete/{id}', 'CategoryController@destroy' )->name( 'delete.category' );

        Route::get( '/category/search', 'CategoryController@searchBrand' )->name( 'brand.search' );

        Route::get( 'active/{id}', 'CategoryController@active' )->name( 'active.category' );
        Route::get( 'deactive/{id}', 'CategoryController@deactive' )->name( 'deactive.category' );
        Route::post( 'multiple/delete', 'CategoryController@multiDelete' )->name( 'category.multi.delete' );

    } );

    //----Sub-Category Route----//
    Route::group( ['prefix' => 'sub-category'], function () {
        Route::get( '/', 'SubCategoryController@index' )->name( 'index.sub_category' );
        Route::post( 'store', 'SubCategoryController@store' )->name( 'store.sub_category' );
        Route::get( 'edit/{id}', 'SubCategoryController@edit' )->name( 'edit.sub_category' );
        Route::post( 'update/{id}', 'SubCategoryController@update' )->name( 'update.sub_category' );
        Route::get( 'delete/{id}', 'SubCategoryController@destroy' )->name( 'delete.sub_category' );

        Route::get( 'active/{id}', 'SubCategoryController@active' )->name( 'active.sub_category' );
        Route::get( 'deactive/{id}', 'SubCategoryController@deactive' )->name( 'deactive.sub_category' );
        Route::post( 'multiple/delete', 'SubCategoryController@multiDelete' )->name( 'sub_category.multi.delete' );

        //-----Subcategory Json-----//
        Route::get( 'get/{cat_id}', 'SubCategoryController@getSubcategory' );
    } );

    //----Brand Route----//
    Route::group( ['prefix' => 'brand'], function () {
        Route::get( '/', 'BrandController@index' )->name( 'index.brand' );
        Route::post( 'store', 'BrandController@store' )->name( 'store.brand' );
        Route::get( 'edit/{id}', 'BrandController@edit' )->name( 'edit.brand' );
        Route::post( 'update/{id}', 'BrandController@update' )->name( 'update.brand' );
        Route::get( 'delete/{id}', 'BrandController@destroy' )->name( 'delete.brand' );

        Route::get( 'active/{id}', 'BrandController@active' )->name( 'active.brand' );
        Route::get( 'deactive/{id}', 'BrandController@deactive' )->name( 'deactive.brand' );
        Route::post( 'multiple/delete', 'BrandController@multiDelete' )->name( 'brand.multi.delete' );
    } );

    //----Supplier Route----//
    Route::group( ['prefix' => 'supplier'], function () {
        Route::get( '/', 'SupplierController@index' )->name( 'index.supplier' );
        Route::post( 'store', 'SupplierController@store' )->name( 'store.supplier' );
        Route::get( 'edit/{id}', 'SupplierController@edit' )->name( 'edit.supplier' );
        Route::post( 'update/{id}', 'SupplierController@update' )->name( 'update.supplier' );
        Route::get( 'delete/{id}', 'SupplierController@destroy' )->name( 'delete.supplier' );

        Route::get( 'active/{id}', 'SupplierController@active' )->name( 'active.supplier' );
        Route::get( 'deactive/{id}', 'SupplierController@deactive' )->name( 'deactive.supplier' );
        Route::post( 'multiple/delete', 'SupplierController@multiDelete' )->name( 'supplier.multi.delete' );

        Route::get( 'code', 'SupplierController@code' ); //----Supplier Code---//
    } );

    //----Size Route----//
    Route::group( ['prefix' => 'size'], function () {
        Route::get( '/', 'SizeController@index' )->name( 'index.size' );
        Route::post( 'store', 'SizeController@store' )->name( 'store.size' );
        Route::get( 'edit/{id}', 'SizeController@edit' )->name( 'edit.size' );
        Route::post( 'update/{id}', 'SizeController@update' )->name( 'update.size' );
        Route::get( 'delete/{id}', 'SizeController@destroy' )->name( 'delete.size' );

        Route::get( 'active/{id}', 'SizeController@active' )->name( 'active.size' );
        Route::get( 'deactive/{id}', 'SizeController@deactive' )->name( 'deactive.size' );
        Route::post( 'multiple/delete', 'SizeController@multiDelete' )->name( 'size.multi.delete' );
    } );

    //----Product Route----//
    Route::group( ['prefix' => 'product'], function () {
        Route::get( '/', 'ProductController@index' )->name( 'index.product' );
        Route::get( '/-{category_slug}', 'ProductController@indexId' )->name( 'index.product.id' );
        Route::get( '/create', 'ProductController@create' )->name( 'create.product' );
        Route::post( 'store', 'ProductController@store' )->name( 'store.product' );
        Route::get( 'edit/{id}', 'ProductController@edit' )->name( 'edit.product' );
        Route::get( 'view/{id}', 'ProductController@show' )->name( 'view.product' );
        Route::post( 'update/{id}', 'ProductController@update' )->name( 'update.product' );
        Route::get( 'delete/{id}', 'ProductController@destroy' )->name( 'delete.product' );

        Route::get( 'active/{id}', 'ProductController@active' )->name( 'active.product' );
        Route::get( 'deactive/{id}', 'ProductController@deactive' )->name( 'deactive.product' );
        Route::post( 'multiple/delete', 'ProductController@multiDelete' )->name( 'product.multi.delete' );

        Route::get( 'code/{supplier_id}', 'ProductController@productCode' ); //----Product Code---//
    } );

    //----Product Route----//
    Route::group( ['prefix' => 'barcode-generate'], function () {

        Route::get( '/create', 'BarcodeGenerateController@create' )->name( 'create.barcode' );
        Route::get( 'print', 'BarcodeGenerateController@store' )->name( 'print.barcode' );

        Route::get( 'product/code/{product_id}', 'BarcodeGenerateController@productCode' ); //----Product Code---//
    } );

    //----Product Route----//
    Route::group( ['prefix' => 'product-purchase'], function () {
        Route::get( '/', 'PurchaseController@index' )->name( 'index.product.purchase' );
        Route::get( '/create', 'PurchaseController@create' )->name( 'create.product.purchase' );
        Route::post( 'store', 'PurchaseController@store' )->name( 'store.product.purchase' );
        Route::get( 'edit/{id}', 'PurchaseController@edit' )->name( 'edit.product.purchase' );
        Route::get( 'view/{id}', 'PurchaseController@show' )->name( 'view.product.purchase' );
        Route::post( 'update/{id}', 'PurchaseController@update' )->name( 'update.product.purchase' );
        Route::get( 'delete/{id}', 'PurchaseController@destroy' )->name( 'delete.product.purchase' );

        Route::post( 'multiple/delete', 'ProductController@multiDelete' )->name( 'product.purchase.multi.delete' );
    } );

    //----Product sale Route----//
    Route::group( ['prefix' => 'product-sale'], function () {
        Route::get( '/kkm', 'SaleController@indexKkm' )->name( 'index.product.sale.kkm' );
        Route::get( '/iqm', 'SaleController@indexIqm' )->name( 'index.product.sale.iqm' );
        Route::get( '/mn', 'SaleController@indexMn' )->name( 'index.product.sale.mn' );

        Route::get( '/invoice', 'SaleController@indexInvoice' )->name( 'index.product.sale.invoice' );

        Route::get( '/kkm/create', 'SaleController@createKkm' )->name( 'create.product.sale.kkm' );
        Route::get( '/iqm/create', 'SaleController@createIqm' )->name( 'create.product.sale.iqm' );
        Route::get( '/mn/create', 'SaleController@createMn' )->name( 'create.product.sale.mn' );

        Route::get( '/invoice/create', 'SaleController@createInvoice' )->name( 'create.product.sale.invoice' );

        Route::post( 'store', 'SaleController@store' )->name( 'store.product.sale' );
        Route::get( 'edit/{id}', 'SaleController@edit' )->name( 'edit.product.sale' );
        Route::get( 'view/{id}', 'SaleController@show' )->name( 'view.product.sale' );
        Route::post( 'update/{id}', 'SaleController@update' )->name( 'update.product.sale' );
        Route::get( 'delete/{id}', 'SaleController@destroy' )->name( 'delete.product.sale' );

        Route::get( 'get/price/{product_id}', 'SaleController@getPrice' );
    } );

    //----Customer Route----//
    Route::group( ['prefix' => 'customer'], function () {
        Route::get( '/', 'CustomerController@index' )->name( 'index.customer' );
        Route::post( 'store', 'CustomerController@store' )->name( 'store.customer' );
        Route::get( 'edit/{id}', 'CustomerController@edit' )->name( 'edit.customer' );
        Route::post( 'update/{id}', 'CustomerController@update' )->name( 'update.customer' );
        Route::get( 'delete/{id}', 'CustomerController@destroy' )->name( 'delete.customer' );

        Route::get( 'get/due/{cus_id}', 'CustomerController@getDue' );
    } );

    //----Amount paid Route----//
    Route::group( ['prefix' => 'customer-amount-paid'], function () {
        Route::get( '/', 'AmountPaidController@index' )->name( 'index.amount.paid' );
        Route::post( 'store', 'AmountPaidController@store' )->name( 'store.amount.paid' );
        Route::get( 'edit/{id}', 'AmountPaidController@edit' )->name( 'edit.amount.paid' );
        Route::post( 'update/{id}', 'AmountPaidController@update' )->name( 'update.amount.paid' );
        Route::get( 'delete/{id}', 'AmountPaidController@destroy' )->name( 'delete.amount.paid' );
    } );

} );