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

// Route::get('/', function () {
//     return view('order.index');
// });

Route::get('/','\App\Http\Controllers\OrderController@index')->name('order.index');


Route::group(['prefix' => 'order'], function() {
    Route::get('/create','\App\Http\Controllers\OrderController@create')->name('order.create');
    Route::post('/store','\App\Http\Controllers\OrderController@store')->name('order.store');
    Route::get('/preview/{id}','\App\Http\Controllers\OrderController@preview')->name('orderdetail.preview');
 });

