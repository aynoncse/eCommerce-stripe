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

Route::get('/', 'FrontendController@index');

Route::resource('products', 'ProductsController');
Route::get('/product/{id}', 'FrontendController@singleProduct')->name('product.single');

Route::post('/cart/add', 'ShoppingController@addToCart')->name('cart.add');
Route::get('/cart', 'ShoppingController@cart')->name('cart');
Route::get('/cart/delete/{id}', 'ShoppingController@cartDelete')->name('cart.delete');
Route::get('/cart/delete/{id}', 'ShoppingController@cartDelete')->name('cart.delete');

Route::get('/cart/decrease/{id}/{qty}', 'ShoppingController@cartDecrease')->name('cart.decrease');

Route::get('/cart/increase/{id}/{qty}', 'ShoppingController@cartIncrease')->name('cart.increase');
Route::get('/cart/rapid/add/{id}', 'ShoppingController@rapidAdd')->name('cart.rapid.add');

Route::get('/cart/checkout', 'CheckoutController@index')->name('cart.checkout');

Route::post('/cart/checkout', 'CheckoutController@pay')->name('cart.checkout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
