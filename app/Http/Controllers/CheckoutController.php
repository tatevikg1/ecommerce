<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;
use App\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripev;


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

    public function store(Request $request)
    {
        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::Current()->total_price,
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'reciept_email' => $request->email,
                'metadata' => [
                    // 'cuntents' => $contents,
                    // 'quantity' => Cart::Currrent()->count(),
                ],]
            );

            return view('thankyou');

        } catch (\Exception $e) {

        }
    }


}
