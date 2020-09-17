<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartItem;
use App\Cart;

class VueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateQuantity($cartItemId, $number)
    {
        $cartItem = CartItem::where('id', $cartItemId)->first();

        $sum = ($number * $cartItem->price) - ($cartItem->price * $cartItem->quantity);

        $cartItem->update(['quantity' => $number]);

        Cart::Current()->updateTotalPrice(true, $sum, 1);

        session()->flash('success_message', 'Quantity was updated successfully.');

        return $cartItem;
    }
}
