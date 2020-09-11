@extends('layouts.app')

@section('content')


<div class="container">
    <h2 class="m-5"><strong>Checkout</strong> </h2>
    <hr>

    <div class="d-flex">
        <div class="col-6">
            <form  action="{{ route('checkout.post') }}" method="POST" id="payment-form">
                @csrf

                <h4><strong>Billing Details</strong> </h4>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                            value="{{ old('email') ? old('email') : auth()->user()->email }}"
                            class="form-control"
                            required>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="city">
                        <label for="">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" required>

                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" name="postal_code" value="" class="form-control" required>
                    </div>
                    <div class="">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" value="{{ old('province') }}" class="form-control" required>

                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control" required>
                    </div>
                </div>

                <h4 class="mt-4"><strong>Payment Details</strong> </h4>

                <div class="form-group ">
                    <label for="name_on_card">Name On Card</label>
                    <input type="text" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="card-element">Credit or debit card</label>
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                </div>

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="submit" name="" value="Complate Order" class="button button-black mb-5">

            </form>
        </div>

        <div class="col-6">
            <hr>
            @foreach ($products as $product)
                <div class="d-flex col-12 mb-3">
                    <div class="col-3">
                        <img src="/laptop.jpg" alt="product image" width='90%'>
                    </div>
                    <div class="col-8">
                        <ul style="list-style: none;padding:0">
                            <li><h5><strong>{{ $product->name }}</strong> </h5></li>
                            <li>{{ $product->detales }}</li>
                            <li>${{ $product->price }}</li>
                        </ul>

                    </div>

                    <div class="col-1">
                        1
                    </div>
                </div>
                <hr>
            @endforeach


            <div class="col-12 d-flex">
                <div class="col-6" style="position:relative; right:-8%">
                    <div class="">Price for product</div>
                    <div class="">Delivery</div>
                    <div class=""><strong>Total</strong> </div>
                </div>

                <div class="col-6" style="text-align:right;">
                    <div class="">${{ ($product->price)*1 }}</div>
                    <div class="">$0</div>
                    <div> ${{ ($product->price)*1 }}</div>
                </div>
            </div>
            <hr>
        </div>
    </div>


</div>

<script type="text/javascript">

// Create a Stripe client.
var stripe = Stripe('pk_test_51HPqQiIvQKcLNgvT0OKs8WpONhgbz5Q3bKNCqEIs2Ve4stfmWFVlJxK1WjSutYtPNeWvIN1PzfFrjjnc1bEPC1WF00ax3Hthc6');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#343434',
    fontFamily: '"Noto Sans", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
     color:' #aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style,
    hidePostalCode:true
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}

</script>

@endsection
