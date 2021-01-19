@if($product->discount > 0)
    <div class="originalPrice">
        {{ $product->originalPrice() }}
    </div>
@endif
    {{ $product->formatedPrice() }}
