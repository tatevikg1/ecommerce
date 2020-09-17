<h5 class="m-5"><strong>You may also like...</strong></h5>


<div class="d-flex flex-wrap justify-content-around">
    @foreach ($randomFour as $product)
        <div class="product m-3">
            <a href="/shop/{{$product->slug}}">
                <img src="/laptop.jpg" width="130px" alt="product">
            </a>
            <a href="/shop/{{$product->slug}}">
                <div class="product-name">{{ $product->name }}</div>
            </a>
            <div class="product-price">{{ $product->formatedPrice() }}</div>
        </div>
    @endforeach
</div>
