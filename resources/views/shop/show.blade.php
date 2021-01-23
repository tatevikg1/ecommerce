@extends('layouts.app')
@section('title', 'E-Commerce')
@section('content')

    <div class="container">
        <div class="row mt-5">

            <div class="col-12 d-flex">

                <div class="col-6">
                    <img src="{{ $product->productImage() }}" 
                        alt="product image" width="70%" 
                        class="p-3 img-thumbnail product-img">
                </div>

                <div class="col-6">
                    <h3 class="product-name"><strong>{{ $product->name }}</strong> </h3>
                    <p>{{ $product->detales }}</p>
                    <h3><strong>
                        @include('partials._price')
                    </strong> </h3>
                    <p>{{ $product->description }}</p>

                    <div class="ta-buttons mt-5">

                        <form class="" action="{{ route('cart.store', $product->id) }}" method="post">
                            @csrf
                            <input type="submit" class="button button-black" value="Add To Cart">
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            @include('partials._randomFour')
        </div>

    </div>

@endsection
