<?php

namespace App\Http\Controllers;

use App\Product;

class HomeController extends Controller
{
    /**
     * @var App\Product $products
    */
    public function index()
    {
        $products = Product::inRandomOrder()->take(8)->get();

        return view('home', compact('products'));
    }
}
