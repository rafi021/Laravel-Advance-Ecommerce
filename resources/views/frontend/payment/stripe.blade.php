@extends('frontend.frontend_master')

@section('title')
    Al Araf Fashion - Stripe Page
@endsection

@section('frontend_style')

<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>
@endsection

@section('frontend_content')
    <div class="checkout-box ">
        <div class="row">
            <div class="col-md-6">
                <!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Your Shopping Amount</h4>
                            </div>
                            <div class="">
                                <ul class="nav nav-checkout-progress list-unstyled">
                                    <hr>
                                    <li>
                                        @if (Session::has('coupon'))
                                            <strong>SubTotal: </strong> ${{ $cart_total }}
                                            <hr>
                                            <strong>Coupon Name: </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ( {{ session()->get('coupon')['coupon_discount'] }} %)
                                            <hr>
                                            <strong>Coupon Discount:
                                            </strong>(-)${{ session()->get('coupon')['discount_amount'] }}
                                            <hr>
                                            <strong>Grand Total: </strong>${{ session()->get('coupon')['total_amount'] }}
                                            <hr>
                                        @else
                                            <strong>SubTotal: </strong> ${{ $cart_total }}
                                            <hr>
                                            <strong>Grand Total: </strong> ${{ $cart_total }}
                                            <hr>
                                        @endif

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- checkout-progress-sidebar -->
            </div>
            <div class="col-md-6">
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <form action="{{ route('stripe.order') }}" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">
                              <label for="card-element">

                            <input type="hidden" name="shipping_name" value="{{ $data['shipping_name'] }}">
                            <input type="hidden" name="shipping_email" value="{{ $data['shipping_email'] }}">
                            <input type="hidden" name="shipping_phone" value="{{ $data['shipping_phone'] }}">
                            <input type="hidden" name="shipping_postCode" value="{{ $data['shipping_postCode'] }}">
                            <input type="hidden" name="division_id" value="{{ $data['division_id'] }}">
                            <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                            <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                            <input type="hidden" name="shipping_address" value="{{ $data['shipping_address'] }}">
                            <input type="hidden" name="shipping_notes" value="{{ $data['shipping_notes'] }}">

                                Credit or debit card
                              </label>
                              <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>

                              <!-- Used to display Element errors. -->
                              <div id="card-errors" role="alert"></div>
                            </div>
                            <br>
                            <button class="btn btn-primary">Submit Payment</button>
                          </form>
                    </div>
                </div>
            </div>
            </div><!-- /.row -->
            <hr>
        </div>
    </div>
@endsection
@section('frontend_script')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    // Create a Stripe client.
var stripe = Stripe('pk_test_51H8TlFIWhXor2KLbagYIph0uQXZ0LIyCTFJLjNgQeoq8IrIPW3KZjRkd1eMz6SPIAB9VaUdb2CKV3B3agInaiFVp004WznlHuO');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
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

