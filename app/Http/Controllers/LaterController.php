<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;

class LaterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * products saved for later
     * @var App\Cart $cart
     * @var App\CartItem $cartItems
    */
    public function index()
    {
        // get the users cart id and find all his cartItems
        $cart = Cart::current();
        $cartItems = CartItem::where('cart_id', $cart->id)->where('for_later', true)->with('product')->get();

        return view('cart.forlater', compact( 'cartItems', 'cart'));
    }

    public function add(CartItem $cartItem)
    {
        $productId = $cartItem->product_id;
        $cart = Cart::Current();

        // chack if the item is already in the cart
        $dublicate = CartItem::where('product_id', $productId)
            ->where('cart_id', $cart->id)
            ->where('for_later', true)
            ->first();

        if($dublicate){
            $cartItem->delete();
            return redirect()->route('later.index')->with('success_message', 'Item was already saved!');
        }

        $cartItem->update(['for_later' => true]);

        // update the total in cart
        $cart->updateTotalPrice(false, $cartItem->price, $cartItem->quantity);

        return redirect()->route('later.index')->with('success_message', 'Item is saved for later.');
    }

    public function destroy(CartItem $cartItem)
    {
        $cart = Cart::current();
        $cart->updateTotalPrice(false, $cartItem->price, $cartItem->quantity);

        $cartItem->delete();

        return redirect()->route('later.index')->with('success_message', 'Item has been removed!');
    }
}
