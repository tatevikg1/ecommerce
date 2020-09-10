<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;


class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function get()
    {
        $products = Product::inRandomOrder()->take(2)->get();

        return view('checkout', compact('products'));
    }

    
}
