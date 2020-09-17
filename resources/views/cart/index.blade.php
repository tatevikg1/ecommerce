@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 mt-5">

        @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{ Session::get('success_message') }}
            </div>
        @endif

        @if($cartItems)
            <h4> {{ count($cartItems) }}  item(s) in Shopping Cart</h4>
            <hr>

            <div class="">
                <?php foreach ($cartItems  as $cartItem): ?>
                    <div class="d-flex col-12" style="padding-left:0;">
                        <div class="col-3" style="left:0">
                            <a href="{{ route('shop.show', $cartItem->product->slug )}}">
                                <img src="/laptop.jpg" alt="product image" width='50%' style="min-width:80px">
                            </a>
                        </div>
                        <div class="col-3">
                            <h5 class="product-name"><strong>{{ $cartItem->product->name }}</strong> </h5>
                            {{ $cartItem->product->detales }}
                        </div>
                        <div class="col-3" style="padding-left:10%">
                            <div class="">
                                <form  action="{{ route('cart.destroy', $cartItem) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit"  value="Remove" class="cart_item_options">
                                </form>

                            </div>
                            <div class="">
                                <form  action="{{ route('later.add', $cartItem) }}" method="post">
                                    @csrf
                                    @method('post')

                                    <input type="submit" value="Save for later" class="cart_item_options">
                                </form>
                            </div>

                        </div>
                        <div class="col-2">
                            <input type="number" min="1" max="100" size='1' value="1" >

                        </div>
                        <div class="col-1">
                            {{ $cartItem->product->formatedPrice() }}
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>

            </div>
        @else
            <h3 class="alert alert-danger">No items in Cart</h3>
        @endif

        <div class="col-12 d-flex mt-4 pt-5 pb-5" style="background-color:lightgray">
            <div class="col-6">
                Delivery is free within the range of 10km and is 1$ for km after that.
            </div>
            <div class="col-3" style="position:relative; right:-8%">
                <div class="">Price for products</div>
                <div class="">Delivery</div>
                <div class=""><strong>Total</strong> </div>
            </div>

            <div class="col-3" style="text-align:right;">
                <div class="">{{ $cart->formatedPrice() }}</div>
                <div class="">$0</div>
                <div class=""><strong> {{ $cart->formatedPrice()  }}</strong></div>
            </div>
        </div>

        <div class="mb-5 mt-5 d-flex justify-content-between">
            <div class="ta-buttons">
                <a href="/shop" class="button button-black">Continue Shoping</a>
            </div>

            @if(count($cartItems) > 0)
                <div class="ta-buttons">
                    <a href="/checkout" class="button button-black">Checkout</a>
                </div>
            @endif

            <div class="ta-buttons">
                <a href="{{ route('later.index') }}" class="button button-black">Saved for Later</a>
            </div>


        </div>

        <div class="m-3 alert alert-success">
            You have no items saved for later.
        </div>


    </div>
    @include('layouts.randomFour')
</div>



@endsection
