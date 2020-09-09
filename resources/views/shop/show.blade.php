@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-5">

            <div class="col-12 d-flex">

                <div class="col-6">
                    <img src="/laptop.jpg" alt="product image" width="70%" style="border:1px solid black">
                </div>

                <div class="col-6">
                    <h3><strong>{{ $product->name }}</strong> </h3>
                    <p>{{ $product->detales }}</p>
                    <h3><strong>${{ $product->price }}</strong> </h3>
                    <p>{{ $product->description }}</p>

                    <div class="ta-buttons mt-5">
                        <a href="/cart/{{ $product->id }}" class="button button-black">Add To Cart</a>
                    </div>
                </div>
            </div>

        </div>

        <h5 class="m-5"><strong>You may also like...</strong></h5>

        <div class="d-flex flex-wrap justify-content-around">

            @foreach ($products as $product)
                <div class="product m-3">
                    <a href="/shop/{{$product->slug}}">
                        <img src="/laptop.jpg" width="130px" alt="product">
                    </a>
                    <a href="/shop/{{$product->slug}}">
                        <div class="product-name">{{ $product->name }}</div>
                    </a>
                    <div class="product-price">{{ $product->price }}</div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
