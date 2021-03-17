<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;


/*
|--------------------------------------------------------------------------
| API Routes               stateless
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

// returns all categories
Route::post ('/admin/get-categories', function(){return App\Category::getCategories();});
// returns all products
Route::post ('/admin/get-products', function(){ return App\Product::all();});
// get photos of product
Route::get ('/admin/get-product-photos/{product}', function(Request $request){
    return App\Photo::where('product_id', $request->product)->get();
});
// create a photo
Route::post ('/admin/phote/store', function(Request $request){

    $imagePath = request('image')->store('uploads', 'public');
    $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
    $image->save();

    App\Photo::create([
        'image' => $imagePath,
        'product_id' =>$request->product_id,
    ]);
});
// delete the photo
Route::delete('/admin/photo/{photo}', function( App\Photo $photo){ $photo->delete(); });