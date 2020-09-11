<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;


class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $products = CartItem::whereIn('cart_id', function($query){
            $query->select('id')->from('carts')->where('user_id', auth()->id())->first();
        })->where('for_later', false)->get();

        return view('checkout', compact('products'));
    }


}
