@extends('layouts.app')

@section('content')
        <div id="app">
            <div class=" bg-gray">
                <header class="with-background">
                    <div class="top-nav container">

                    </div>
                    <div class="ta container">
                        <div class="ta-copy">
                            <h1>Laravel Ecommerce</h1>
                            <p>Includes multiple products, categories, a shopping cart and a checkout system with Stripe integration.</p>
                            <div class="ta-buttons">
                                <a href="https://github.com/tatevikg1/ecommerce.git" class="button button-white">GitHub</a>
                            </div>
                        </div>

                        <div class="ta-image">
                            <img src="laptop.jpg" alt="image" width='450px'>
                        </div>
                    </div>
                </header>
            </div>


            <div class="featured-section white-bg">

                <div class="container">
                    <h1 class="text-center">Laravel Ecommerce</h1>

                    <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem.</p>

                    <div class="text-center button-container">
                        <a href="#" class="button button-black">Featured</a>
                        <a href="#" class="button button-black">On Sale</a>
                    </div>


                    <div class="products text-center">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    <img src="{{ asset('storage/img/'.$product->image )}}" width="130px" alt="product">
                                </a>
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    <div class="product-name">{{ $product->name }}</div>
                                </a>
                                <div class="">{{ $product->formatedPrice() }}</div>
                            </div>
                        @endforeach

                    </div>

                    <div class="text-center button-container">
                        <a href="/shop" class="button button-black">View more products</a>
                    </div>

                </div>

            </div>


        </div>
        <!-- <script src="js/app.js"></script> -->
@endsection
