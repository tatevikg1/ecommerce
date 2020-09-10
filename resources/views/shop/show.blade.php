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

                        <form class="" action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="submit" class="button button-black" value="Add To Cart">
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>


        @include('layouts.randomFour')

    </div>

@endsection
