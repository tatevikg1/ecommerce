@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-5">

            <div class="col-12 d-flex">
                <div class="product col-3">
                    <h6><strong>By Category</strong></h6>
                    <ul style="list-style: none;padding:0">
                        @foreach($categories as $category)
                            <li class="{{ request()->category == $category->slug ? 'active' : ''}}" >
                                <a href="{{ route('shop.index', ['category' => $category->slug])}}" class="product-name">{{ $category->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                    <h6><strong>By Price</strong></h6>
                    <ul style="list-style: none;padding:0">
                        <li><a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low'])}}" class="spicy">From high to low</a></li>
                        <li><a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high'])}}" class="spicy">From low to high</a></li>
                    </ul>

                </div>

                <div class="col-9">
                    <h3 style="text-align:center"><strong class="product-name">{{ $category_name }}</strong> </h3>

                    <div class="mt-5 d-flex flex-wrap justify-content-around">

                        @forelse ($products as $product)
                            <div class="product m-3">
                                <a href="/shop/{{$product->slug}}">
                                    <img src="{{ asset('storage/img/'.$product->image )}}" 
                                        width="130px" alt="product"
                                        class=" product-img img-thumbnail">
                                </a>
                                <a href="/shop/{{$product->slug}}">
                                    <div class="product-name">{{ $product->name }}</div>
                                </a>
                                <div class="product-price">{{ $product->formatedPrice() }}</div>
                            </div>
                        @empty
                            <div class="">
                                No items found.
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
