<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{


    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('shop.index' , compact('products', 'categories'));
    }



    public function show($slug)
    {
        $randomFour = Product::randomFour()->get();
        $product = Product::where('slug', $slug)->firstOrFail();


        return view('shop.show', compact('product', 'randomFour'));
    }

}
