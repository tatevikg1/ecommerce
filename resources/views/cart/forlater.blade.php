@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-12 mt-5">

        @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
        @endif


        @if($cartItems)
            <h4> {{ count($cartItems) }}  item(s) saved for later!</h4>
            <hr>

            <div class="">
                <?php foreach ($cartItems  as $cartItem): ?>
                    <div class="d-flex col-12" style="padding-left:0;">
                        <div class="col-3" style="left:0">
                            <a href="{{ route('shop.show', $cartItem->product->slug ) }}">
                                <img src="/laptop.jpg" alt="product image" width='50%' style="min-width:80px">
                            </a>
                        </div>
                        <div class="col-3">
                            <h5 class="product-name"><strong>{{ $cartItem->product->name }}</strong> </h5>
                            {{ $cartItem->product->detales }}
                        </div>
                        <div class="col-3" style="padding-left:10%">
                            <div class="">
                                <form  action="{{ route('later.destroy', $cartItem->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit"  value="Remove" class="cart_item_options">
                                </form>

                            </div>
                            <div class="">
                                <form  action="{{ route('cart.tocart', $cartItem->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="submit" value="Save to Cart" class="cart_item_options">
                                </form>
                            </div>

                        </div>
                        <div class="col-2">
                            <input type="number" min="1" max="100" size='1' value="1" >

                        </div>
                        <div class="col-1">
                            {{ $cartItem->product->formatedPrice() }}
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>

            </div>
        @else
            <h3 class="alert alert-danger">No items saved for later!</h3>
        @endif


        <div class="mb-5 mt-5 d-flex justify-content-between">
            <div class="ta-buttons">
                <a href="/shop" class="button button-black">Continue Shoping</a>
            </div>

            <div class="ta-buttons">
                <a href="/cart" class="button button-black">Shopping Cart</a>
            </div>

        </div>


    </div>

</div>



@endsection
