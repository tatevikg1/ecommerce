<?php

use Illuminate\Support\Facades\Route;
use App\Product;

Route::get('/', function(){
    return redirect()->route('Home');
});

Auth::routes();

Route::get('/home',   'HomeController@index')->name('Home');

Route::get('/shop',         'ShopController@index')->name('shop.index');
Route::get('/shop/{slug}',  'ShopController@show')->name('shop.show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart',   'CartController@store')->name('cart.store');
Route::get('/destroy', 'CartController@destroy')->name('cart.destroy');

Route::get('/checkout',     'CheckoutController@get');
// Route::post('/checkout',    'CheckoutController@post')->name('checkout.post');

Route::get('/thankyou', function(){
    return view('thankyou');
});
