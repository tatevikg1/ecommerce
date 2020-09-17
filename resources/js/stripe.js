
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
        fontSize: '14px',
        '::placeholder': {
            color:' #2a2724'
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

    // disable the button so duble clicking will not submit twice
    document.getElementById('card-button').disabled = true;

    var options = {
        name:document.getElementById('name_on_card').value,
        address_line1:document.getElementById('address').value,
        address_city:document.getElementById('city').value,
        address_state:document.getElementById('province').value,
        address_zip:document.getElementById('postal_code').value,
        address_country:document.getElementById('country').value

    }

    stripe.createToken(card, options).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            // if there was sn error enable the button so the user can submit the form again
            document.getElementById('card-button').disabled = false;
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
