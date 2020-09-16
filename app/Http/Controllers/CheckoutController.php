<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;
use App\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
// use Laravel\Cashier\Cashier;


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

        $total = Cart::Current()->total_price;
        

        return view('checkout', compact('products', 'total'));
    }

    public function store(Request $request)
    {
        // get the current user
        $user = auth()->user();
        // try to get the user as stripecustomer
        $stripeCustomer = $user->asStripeCustomer();
        // if he is not yet a stripe customer create him as stripe customer
        if($stripeCustomer == 'undefined'){
            $stripeCustomer = $user->createAsStripeCustomer();
        }

        // get stripme api key from the .env file
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        // $intent = \Stripe\PaymentIntent::create([
        //   'amount' => Cart::Current()->total_price,
        //   'currency' => 'usd',
        //   // Verify your integration in this guide by including this parameter
        //   'metadata' => ['integration_check' => 'accept_a_payment'],
        //   'payment_method_types' => ['card'],
        // ]);

        // charge the the card provided by the user
        $charge = \Stripe\Charge::create([
          'amount' => Cart::Current()->total_price,
          'currency' => 'usd',
          'description' => 'Example charge',
          'receipt_email' => $request->email,
          'source' => $request->stripeToken
          // 'metadata' => ['order_id' => '6735'],
        ]);

        // delete items in cart
        CartItem::where('cart_id', Cart::Current()->id)->where('for_later', false)->delete();
        // reset the total_price
        Cart::Current()->update(['total_price' => 0]);

        return redirect()->route('thankyou')->with('success_message', 'Your payment succeded!');

    }


}
