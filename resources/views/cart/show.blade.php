@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 mt-5">
        <div class="alert alert-success">
            Item has been saved to Cart
        </div>
        <h4>1 item(s) in Shopping Cart</h4>
        <hr>

        <div class="d-flex col-12">
            <div class="col-3">
                <img src="/laptop.jpg" alt="product image" width='90%'>
            </div>
            <div class="col-5">
                <h5><strong>{{ $product->name }}</strong> </h5>
                {{ $product->detales }}
            </div>
            <div class="col-1">
                <div class="">
                    <a href="#">Remove</a>
                </div>
                <div class="">
                    <a href="#">Save for later</a>
                </div>

            </div>
            <div class="col-1">
                <input type="number" min="1" max="100" size='1' value="1">
            </div>
            <div class="col-2" style="text-align:right">
                ${{ $product->price }}
            </div>
        </div>
        <hr>

        <div class="col-12 d-flex mt-4 pt-5 pb-5" style="background-color:lightgray">
            <div class="col-6">
                Delivery is free within the range of 10km and is 1$ for km after that.
            </div>
            <div class="col-3" style="position:relative; right:-8%">
                <div class="">Price for product</div>
                <div class="">Delivery</div>
                <div class=""><strong>Total</strong> </div>
            </div>

            <div class="col-3" style="text-align:right;">
                <div class="">${{ ($product->price)*1 }}</div>
                <div class="">$0</div>
                <div class=""><strong> ${{ ($product->price)*1 }}</strong></div>
            </div>
        </div>

        <div class="mb-5 mt-5 d-flex justify-content-between">
            <div class="ta-buttons">
                <a href="/shop" class="button button-black">Continue Shoping</a>
            </div>

            <div class="ta-buttons">
                <a href="/checkout" class="button button-black">Checkout</a>
            </div>

        </div>

        <div class="m-3">
            <h5>You have no items saved for later.</h5>
        </div>
    </div>
</div>



@endsection
