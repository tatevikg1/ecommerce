<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{
    public function index()
    {

        $categories = Category::all();

        if(request()->category){

            $products = Product::whereIn('category_id', function($query){
                $query->select('id')->from('categories')->
                where('slug', request()->category)->first();
            })->get();

            $category_name = optional($categories->where('slug', request()->category)->first())->name;

        }else{
            $products = Product::all();
            // dd($products);
            $category_name = "All categories";
        }

        if(request()->sort == 'low_high'){

            $products = $products->sortBy('price');

        }elseif(request()->sort == 'high_low'){

            $products = $products->sortByDesc('price');
        }

        return view('shop.index' , compact('products', 'categories', "category_name"));
    }


    public function show($slug)
    {
        if (!function_exists('dd')) {
            function dd()
            {
                array_map(function($x) { 
                    var_dump($x); 
                }, func_get_args());
                die;
            }
        }
        $randomFour = Product::randomFour()->get();
        dd($randomFour);
        $product = Product::where('slug', $slug)->firstOrFail();


        return view('shop.show', compact('product', 'randomFour'));
    }

}
