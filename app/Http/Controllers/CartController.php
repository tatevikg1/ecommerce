<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;
use App\Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // randomFour is a static function in product model
        $randomFour = Product::randomFour()->get();

        // get the users cart id and find all his cartItems
        $cart = Cart::where('user_id', auth()->id())->first();
        $cartItems = CartItem::where('cart_id', $cart->id)->get();


        return view('cart.index', compact('randomFour', 'cartItems'));
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        $product = Product::find($request->id);

        $cart->cartItems()->create([
            'product_id' => $product->id,
        ]);

        $cart->total_price = $cart->total_price + $product->price;


        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart.');
    }

    public function destroy(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        CartItem::where('cart_id', $cart->id)->delete();

        return redirect()->route('cart.index');
    }


}
