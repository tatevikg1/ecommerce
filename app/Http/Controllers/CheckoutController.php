<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CartItem;
use App\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Exception\CardException;
use App\Http\Requests\CheckoutRequest;

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

    public function store(CheckoutRequest $request)
    {
        // // get the current user
        // $user = auth()->user();
        // // try to get the user as stripecustomer
        // $stripeCustomer = $user->asStripeCustomer();
        // // if he is not yet a stripe customer create him as stripe customer
        // if($stripeCustomer == 'undefined'){
        //     $stripeCustomer = $user->createAsStripeCustomer();
        // }

        // get stripme api key from the .env file
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try{
            // charge the the card provided by the user
            $charge = \Stripe\Charge::create([
              'amount' => Cart::Current()->total_price,
              'currency' => 'usd',
              'description' => 'Example charge',
              'receipt_email' => $request->email,
              'source' => $request->stripeToken
              // 'metadata' => ['order_id' => '6735'],
            ]);

            // empty is a function in cart model
            Cart::Current()->empty();

            return redirect()->route('thankyou')->with('success_message', 'Your payment succeded!');

        }catch(CardException $e){
            // if the card has expired, return with error message
            return redirect()->back()->withErrors('Error! ' . $e->getMessage());
        }

    }


}
