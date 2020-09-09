<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CartController extends Controller
{
    function create(Product $product)
    {
        return view('cart.show', compact('product'));
    }
}
