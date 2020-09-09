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

Route::get('/cart/{product}',    'CartController@create');

Route::get('/checkout',     function(){
    $products = Product::inRandomOrder()->take(2)->get();

    return view('checkout', compact('products'));
});

Route::get('/thankyou', function(){
    return view('thankyou');
});
