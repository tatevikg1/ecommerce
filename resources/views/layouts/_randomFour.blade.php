<hr>

<h5 class="m-5 spicy"><strong>You may also like...</strong></h5>


<div class="d-flex flex-wrap justify-content-around">
    @foreach ($randomFour as $product)
        <div class="product m-3">
            <a href="/shop/{{$product->slug}}">
                <img src="{{ asset('storage/img/'.$product->image )}}" 
                width="130px" 
                alt="product"
                class="img-thumbnail product-img">
            </a>
            <a href="/shop/{{$product->slug}}">
                <div class="product-name">{{ $product->name }}</div>
            </a>
            <div class="product-price">@include('layouts._price')</div>
        </div>
    @endforeach
</div>

