<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Product;

Route::get('/', function(){
    return redirect()->route('Home');
});

Auth::routes();

Route::get('/home',   'HomeController@index')->name('Home');

Route::get('/shop',         'ShopController@index')->name('shop.index');
Route::get('/shop/{slug}',  'ShopController@show') ->name('shop.show');

Route::get    ('/cart',             'CartController@index') ->name('cart.index');
Route::post   ('/cart/{product}',   'CartController@store') ->name('cart.store');
Route::delete ('/cart/{cartItem}',  'CartController@destroy')->name('cart.destroy');
Route::patch  ('/cart/{cartItem}',  'CartController@tocart')->name('cart.tocart');

Route::post   ('/later/{cartItem}', 'LaterController@add')  ->name('later.add');
Route::get    ('/later',            'LaterController@index')->name('later.index');
Route::delete ('/later/{cartItem}', 'LaterController@destroy')->name('later.destroy');

Route::get('/checkout',     'CheckoutController@index')->name('checkout.index');
Route::post('/checkout',    'CheckoutController@store')->name('checkout.store');

Route::get('/thankyou', function(){
    return view('thankyou');
})->name('thankyou');


Route::post   ('/update_quantity/{cartItemId}/{number}', 'VueController@updateQuantity');
Route::post   ('/cart-items-quantity', 'VueController@getCartItemsQuantity');