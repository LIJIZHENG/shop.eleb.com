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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::resource('goodsaccount','GoodsaccountController');
Route::get('goodsaccount.login','GoodsaccountController@login')->name('login');
Route::post('goodsaccount.check','GoodsaccountController@check')->name('check');
Route::get('goodsaccount.logut', 'GoodsaccountController@logut')->name('logut');
Route::get('goodsaccount.revise', 'GoodsaccountController@revise')->name('revise');
Route::post('goodsaccount.revise', 'GoodsaccountController@revise')->name('revise');
Route::resource('menuclass','MenuClassController');
Route::resource('menu','MenuController');
Route::post('/upload','UploadController@upload');
Route::resource('activity','ActivityController');
Route::resource('addoreder','AddorederController');
Route::get('addoreder.orders','AddorederController@orders')->name('orders');
Route::get('addoreder.recall','AddorederController@recall')->name('recall');
Route::get('addoreder.restore','AddorederController@restore')->name('restore');
Route::get('addoreder.amount','AddorederController@amount')->name('amount');
Route::get('addoreder.dishes','AddorederController@dishes')->name('dishes');
Route::get('/start','EventController@start');
Route::resource('event','EventController');
Route::get('/lottery','EventController@lottery');
