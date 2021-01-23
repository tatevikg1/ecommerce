<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/',             'HomeController@index')    ->name('Home');
Route::get('/shop',         'ShopController@index')    ->name('shop.index');
Route::get('/shop/{slug}',  'ShopController@show')     ->name('shop.show');
Route::get('/checkout',     'CheckoutController@index')->name('checkout.show');
Route::post('/checkout',    'CheckoutController@store')->name('checkout.store');
Route::get('/thankyou',  function() {return view('thankyou');})->name('thankyou');

Route::prefix('cart')->group(function (){
    Route::get    ('/',             'CartController@index') ->name('cart.index');
    Route::post   ('/{product}',   'CartController@store')  ->name('cart.store');
    Route::delete ('/{cartItem}',  'CartController@destroy')->name('cart.destroy');
    Route::patch  ('/{cartItem}',  'CartController@tocart') ->name('cart.update');    
});

Route::prefix('later')->group(function (){
    Route::post   ('/later/{cartItem}', 'LaterController@add')    ->name('later.update');
    Route::get    ('/later',            'LaterController@index')  ->name('later.index');
    Route::delete ('/later/{cartItem}', 'LaterController@destroy')->name('later.destroy');    
});

Route::prefix('admin')->group(function () {
    Route::get      ('/',                     'Admin\AdminController@index')    ->name('admin.index');

    Route::get      ('/category',             'Admin\CategoryController@index') ->name('admin.category.index');
    Route::delete   ('/category/{category}',  'Admin\CategoryController@destroy')->name('admin.category.destroy');
    Route::post     ('/category',             'Admin\CategoryController@store') ->name('admin.category.store');

    Route::get      ('/product',              'Admin\ProductController@index')  ->name('admin.product.index');
    Route::post     ('/product',              'Admin\ProductController@store')  ->name('admin.product.store');
    Route::delete   ('/product/{product}',    'Admin\ProductController@destroy')->name('admin.product.destroy');
    Route::patch    ('/product/{product}',    'Admin\ProductController@update') ->name('admin.product.update');
});

// returns the number of items in cart
Route::post   ('/cart-items-quantity', 'VueController@getCartItemsQuantity');
// updatets the quantity of product in cart
Route::post   ('/update_quantity/{cartItemId}/{number}', 'VueController@updateQuantity');
