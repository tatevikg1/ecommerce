@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="m-5"><strong>Checkout</strong> </h2>
    <hr>

    <div class="d-flex">
        <div class="col-6">
            <form class="" action="index.html" method="post">

                <h4><strong>Billing Details</strong> </h4>

                <div class="form-group">
                    <label for="">Email Address</label>
                    <input type="text" name="" value="" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="" value="" class="form-control">
                </div>
                <div class="d-flex justify-content-between">
                    <div class="">
                        <label for="">City</label>
                        <input type="text" name="" value="" class="form-control">

                        <label for="">Postal Code</label>
                        <input type="text" name="" value="" class="form-control">
                    </div>
                    <div class="">
                        <label for="">Province</label>
                        <input type="text" name="" value="" class="form-control">

                        <label for="">Phone</label>
                        <input type="text" name="" value="" class="form-control">
                    </div>
                </div>

                <h4><strong>Payment Details</strong> </h4>

                <div class="form-group">
                    <label for="">Name On Card</label>
                    <input type="text" name="" value="" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Credit Card Number</label>
                    <input type="text" name="" value="" class="form-control">
                </div>

                <div class="form-group">
                    <label for="">Expiration Date</label>
                    <input type="date" name="" value="" class="form-control">
                </div>

                <input type="button" name="" value="Complate Order" class="button button-black mb-5">

            </form>
        </div>

        <div class="col-6">
            <hr>
            @foreach ($products as $product)
                <div class="d-flex col-12 mb-3">
                    <div class="col-3">
                        <img src="/laptop.jpg" alt="product image" width='90%'>
                    </div>
                    <div class="col-8">
                        <ul style="list-style: none;padding:0">
                            <li><h5><strong>{{ $product->name }}</strong> </h5></li>
                            <li>{{ $product->detales }}</li>
                            <li>${{ $product->price }}</li>
                        </ul>

                    </div>

                    <div class="col-1">
                        1
                    </div>
                </div>
            @endforeach

            <hr>

            <div class="col-12 d-flex">
                <div class="col-6" style="position:relative; right:-8%">
                    <div class="">Price for product</div>
                    <div class="">Delivery</div>
                    <div class=""><strong>Total</strong> </div>
                </div>

                <div class="col-6" style="text-align:right;">
                    <div class="">${{ ($product->price)*1 }}</div>
                    <div class="">$0</div>
                    <div> ${{ ($product->price)*1 }}</div>
                </div>
            </div>
            <hr>
        </div>
    </div>


</div>


@endsection
