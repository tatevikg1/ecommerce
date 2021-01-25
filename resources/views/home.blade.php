@extends('layouts.app')
@section('title', 'E-Commerce')
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

                    <p class="section-description">Is there anything better than getting cozy on the couch on a rainy day and shopping  online?</p>
                    <p class="section-description">Online shopping is the process of buying goods and services from merchants who sell on the Internet. Since the emergence of the World Wide Web, merchants have sought to sell their products to people who surf the Internet. Shoppers can visit web stores from the comfort of their homes and shop as they sit in front of the computer. </p>
                    <p class="section-description">Consumers buy a variety of items from online stores. In fact, people can purchase just about anything from companies that provide their products online. Books, clothing, household appliances, toys, hardware, software, and health insurance are just some of the hundreds of products consumers can buy from an online store. </p>
                    <p class="section-description">Many people choose to conduct shopping online because of the convenience. For example, when a person shops at a brick-and-mortar store, she has to drive to the store, find a parking place, and walk throughout the store until she locates the products she needs. After finding the items she wants to purchase, she may often need to stand in long lines at the cash register. </p>
                    
                    
                    <div class="text-center button-container">
                        <a href="{{ route('shop.index', ['onsale' => 'sale']) }}" class="button button-black">On Sale</a>
                        <a href="#" class="button button-black">Featured</a>
                    </div>


                    <div class="products text-center">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    <div >
                                        <img src="{{ $product->productImage() }}" 
                                            width="130px" alt="product" 
                                            class="product-img img-thumbnail">
                                    </div>
                                </a>
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    <div class="product-name">{{ $product->name }}</div>
                                </a>
                                <div class="">
                                    @include('partials._price')
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center button-container">
                        <a href="{{ route('shop.index') }}" class="button button-black">View more products</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
