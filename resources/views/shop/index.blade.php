@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-5">

            <div class="col-12 d-flex">
                <div class="col-3">
                    <h6><strong>By Category</strong></h6>
                    <ul style="list-style: none;padding:0">
                        @foreach($categories as $category)
                            <li>{{ $category->name }}</li>
                        @endforeach

                    </ul>
                    <h6><strong>By Price</strong></h6>
                        <ul style="list-style: none;padding:0">
                            <li>$0-$100</li>
                            <li>$100-$200</li>
                            <li>$200-$300</li>
                            <li>$300+</li>
                        </ul>

                </div>

                <div class="col-9">
                    <h3 style="text-align:center"><strong>{{ $category->name }}</strong> </h3>

                    <div class="mt-5 d-flex flex-wrap justify-content-around">

                        @foreach ($products as $product)
                            <div class="product m-3">
                                <a href="/shop/{{$product->slug}}">
                                    <img src="laptop.jpg" width="130px" alt="product">
                                </a>
                                <a href="/shop/{{$product->slug}}">
                                    <div class="product-name">{{ $product->name }}</div>
                                </a>
                                <div class="product-price">${{ $product->price }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
