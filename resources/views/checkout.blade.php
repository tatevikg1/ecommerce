@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="m-5"><strong>Checkout</strong> </h2>
    <hr>

    <div class="d-flex">
        <div class="col-6">
            <form  action="{{ route('checkout.post') }}" method="POST">
                @csrf

                <h4><strong>Billing Details</strong> </h4>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                            value="{{ old('email') ? old('email') : auth()->user()->email }}"
                            class="form-control"
                            required>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="city">
                        <label for="">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" required>

                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" value="" class="form-control" required>
                    </div>
                    <div class="">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" value="{{ old('province') }}" class="form-control" required>

                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" required>
                    </div>
                </div>

                <h4><strong>Payment Details</strong> </h4>

                <div class="form-group">
                    <label for="name_on_card">Name On Card</label>
                    <input type="text" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="credit_card_number">Credit Card Number</label>
                    <input type="text" id="credit_card_number" name="credit_card_number" value="{{ old('credit_card_number') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="expiration_date">Expiration Date</label>
                    <input type="date" id="expiration_date" name="expiration_date" value="{{ old('expiration_date') }}" class="form-control" required>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="submit" name="" value="Complate Order" class="button button-black mb-5">

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
