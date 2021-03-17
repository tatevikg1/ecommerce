<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Cart;

class VueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param App\CartItem $cartItemId
     * @param int $number
     * 
     * @return App\CartItem
    */
    public function updateQuantity(CartItem $cartItem, $number)
    {
        // $cartItem = CartItem::where('id', $cartItemId)->first();

        $sum = ($number * $cartItem->price) - ($cartItem->price * $cartItem->quantity);

        $cartItem->update(['quantity' => $number]);

        Cart::Current()->updateTotalPrice(true, $sum, 1);

        session()->flash('success_message', 'Quantity was updated successfully.');

        return $cartItem;
    }

    public function getCartItemsQuantity()
    {
        $cart_id =  Cart::Current()->id;
        return CartItem::where('cart_id', $cart_id)->where('for_later', false)->sum('quantity');
    }
}
