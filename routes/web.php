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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('product/create', 'ProductController@create')->name('product.create');
Route::post('product', 'ProductController@store')->name('product.store');
Route::delete('product/{product}', 'ProductController@destroy')->name('product.destroy');

Route::group(['prefix' => 'json'], function () {
    Route::post('sizes', 'JSONController@sizes')->name('json.sizes');
});
