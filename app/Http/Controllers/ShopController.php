<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;

class ShopController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();

        if(request()->category  && request()->onsale){

            $products = Product::where('discount',  '>', '0')->whereIn('category_id', function($query){
                $query->select('id')->from('categories')->
                where('slug', request()->category)->first();
            })->get();
            $category_name =  optional($categories->where('slug', request()->category)->first())->name . " on sale" ;
            
        }elseif(request()->category){
        
            $products = Product::whereIn('category_id', function($query){
                $query->select('id')->from('categories')->
                where('slug', request()->category)->first();
            })->get();
            $category_name = optional($categories->where('slug', request()->category)->first())->name;
        
        }elseif(request()->onsale){
        
            $products = Product::where('discount',  '>', '0')->get();
            $category_name = "On Sale";
        
        }else{
            $products = Product::all();
            $category_name = "All categories";
        }

        if(request()->sort == 'low_high'){

            $products = $products->sortBy('price');

        }elseif(request()->sort == 'high_low'){

            $products = $products->sortByDesc('price');
        }

        return view('shop.index' , compact('products', 'categories', "category_name"));
    }

     /**
     * Show the product page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show($slug)
    {
        $randomFour = Product::randomFour()->get();
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop.show', compact('product', 'randomFour'));
    }

}