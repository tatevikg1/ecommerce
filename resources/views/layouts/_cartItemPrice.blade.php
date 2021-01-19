@if($cartItem->product->discount > 0)
    <div class="originalPrice">
        {{ $cartItem->product->originalPrice() }}
    </div>
@endif
    {{ $cartItem->product->formatedPrice() }}
