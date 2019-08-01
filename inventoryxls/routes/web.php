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


Route::get('admin/index',['as'=>'admin.index' , 'uses'=> 'ProductController@index']);
// Route::get('admin/importExport', 'ProductController@importExport');

Route::get('downloadExcel/{type}', 'ProductController@downloadExcel');

Route::get('Excel/{type}', 'ProductController@Excel');

Route::post('importExcel', 'ProductController@importExcel');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('admin/sell_edit/{id}', ['as' => 'admin.sell_edit' , 'uses'=> 'ProductController@sell_edit']);

Route::post('admin/sell_delete/{id}', ['as' => 'admin.sell_delete' , 'uses'=> 'ProductController@sell_delete']);

Route::post('admin/sell_edit1/{id}', ['as' => 'admin.sell_edit1' , 'uses'=> 'ProductController@sell_edit1']);

Route::get('admin/add_product', ['as' => 'admin.add_product' , 'uses'=> 'ProductController@add_product']);

Route::post('admin/store_product', ['as' => 'admin.store_product' , 'uses'=> 'ProductController@store_product']);

Route::get('admin/sell_product', ['as' => 'admin.sell_product' , 'uses'=> 'ProductController@sell_product']);

Route::post('admin/query_sell', ['as' => 'admin.query_sell' , 'uses'=> 'ProductController@query_sell']);

Route::post('admin/sell_product1/{id}', ['as' => 'admin.sell_product1' , 'uses'=> 'ProductController@sell_product1']);

Route::get('admin/add_same_product', ['as' => 'admin.add_same_product' , 'uses'=> 'ProductController@add_same_product']);

Route::get('admin/add_same_product', ['as' => 'admin.add_same_product' , 'uses'=> 'ProductController@add_same_product']);

Route::post('admin/add_same_product_query', ['as' => 'admin.add_same_product_query' , 'uses'=> 'ProductController@add_same_product_query']);


Route::post('admin/add_same_product1/{id}', ['as' => 'admin.add_same_product1' , 'uses'=> 'ProductController@add_same_product1']);

Route::get('admin/buy_edit/{id}', ['as' => 'admin.buy_edit' , 'uses'=> 'ProductController@buy_edit']);

Route::post('admin/buy_edit1/{id}', ['as' => 'admin.buy_edit1' , 'uses'=> 'ProductController@buy_edit1']);

Route::post('admin/buy_delete/{id}', ['as' => 'admin.buy_delete' , 'uses'=> 'ProductController@buy_delete']);

Route::post('admin/query_sell_multiply/{id}', ['as' => 'admin.query_sell_multiply' , 'uses'=> 'ProductController@query_sell_multiply']);

