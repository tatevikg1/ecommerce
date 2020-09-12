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
        // get the users cart id and find all his cartItems
        $cart = Cart::Current();

        $cartItems = CartItem::where('cart_id', $cart->id)
                            ->where('for_later', false)
                            ->with('product')
                            ->get();

        // randomFour is a static function in product model
        $randomFour = Product::randomFour()
        // excludes products that are allrerady in cart
            ->whereNotIn('id', $cartItems->map(function($item){
                return $item->product->id;
            }))
            ->get();


        return view('cart.index', compact('randomFour', 'cartItems', 'cart'));
    }

    public function store(Product $product)
    {
        // get the instance of users cart
        $cart = Cart::where('user_id', auth()->id())
                    ->with('cartItems')->first();

        // chack if the item is already in the cart
        $dublicate = CartItem::where('product_id', $product->id)
                    ->where('cart_id', $cart->id)
                    ->where('for_later', false)
                    ->first();

        if($dublicate){

            return redirect()->route('cart.index')->with('success_message', 'Item was already in your cart!');
        }

        $cart->cartItems()->create([
            'product_id' => $product->id,
            'price' => $product->price,
        ]);

        // updateTotalPrice is a function in cart model
        $cart->updateTotalPrice(true, $product->price, 1);

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart.');
    }

    public function destroy(CartItem $cartItem)
    {
        $cart = Cart::Current();
        $cart->updateTotalPrice(false, $cartItem->price, $cartItem->quantity);

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success_message', 'Item has been removed!');
    }

    public function tocart(CartItem $cartItem)
    {
        $cartItem->update(['for_later' => false]);

        // update the total in cart
        $cart = Cart::Current();
        $cart->updateTotalPrice(true, $cartItem->price, $cartItem->quantity);

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart.');
    }







    // public function destroy(Request $request)
    // {
    //     $cart = Cart::where('user_id', auth()->id())->first();
    //
    //     // delete items in cart
    //     CartItem::where('cart_id', $cart->id)->delete();
    //     // reset the total_price
    //     $cart->update(['total_price' => 0]);
    //
    //
    //     return redirect()->route('cart.index');
    // }


}
