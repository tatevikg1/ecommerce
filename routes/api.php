<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('api/categories', function(){
//     $categories = Categories::all()->name();
//     return $categories;
// })->name('api/categories');


// Route::post   ('/update_quantity/{cartItemId}/{number}', 'VueController@updateQuantity');
// Route::post   ('/cart-items-quantity', 'VueController@getCartItemsQuantity');