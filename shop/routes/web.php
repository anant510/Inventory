<?php

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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('index', 'DashboardController@index')->name('index');


//Vendor Route
Route::get('vendor/index', 'VendorController@index')->name('vendor.index');
Route::post('vendor/store', 'VendorController@store')->name('vendor.store');


//Vedor End

//Vendor Route datatables

Route::resource('ajaxproducts','ProductAjaxController');

//end


//product category

Route::get('product_cat/index','ProductCategory@index')->name('product_cat.index');


Route::resource('ajaxcategoryproducts','ProductAjaxCategory');

//end


//product information

Route::get('product_info/index', 'ProductInformation@index')->name('product_info.index');

Route::resource('ajaxinformation','ProductAjaxInformation');

//Route::get('test', 'ProductAjaxInformation@index')->name('test');


//end product information


//Start Stock IN

Route::get('stock_in/index', 'StockINController@index')->name('stock_in.index');

Route::resource('ajax_stock_in','StockINAjaxController');

Route::post('stock_in/stockin_quantity_update/{id}', 'StockINController@quantity_update')->name('stock_in.stockin_quantity_update');

Route::post('stock_in/stockin_quantity_subtract/{id}', 'StockINController@quantity_subtract')->name('stock_in.stockin_quantity_subtract');

//Route::get('test', 'StockINAjaxController@index')->name('test');


//end stock


//Stock OUT

Route::get('stock_out/index', 'StockoutController@index')->name('stock_out.index');

Route::post("stock_out/store","StockoutController@store")->name('stock_out.store');

Route::get("stock_out/category_data","StockoutController@category_data")->name('stock_out.category_data');

Route::post("stock_out/total_value", "StockoutController@price")->name('stock_out.total_value');

//ENd Stock Out
