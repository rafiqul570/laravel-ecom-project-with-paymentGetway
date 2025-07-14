<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>স্ট্রাইপ দিয়ে পেমেন্ট</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body { background-color: #f1f5f9; }
        .stripe-card { max-width: 480px; margin-top: 5%; }
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
            background-color: #fefde5 !important;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card stripe-card shadow-sm">
                <div class="card-header text-center">
                    <h4 class="fw-bold">কার্ড দিয়ে পেমেন্ট করুন</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <p><strong>ইনভয়েস নং:</strong> {{ $order->invoice_no }}</p>
                        <p><strong>পরিশোধের পরিমাণ:</strong> ৳ {{ number_format($order->amount, 2) }}</p>
                    </div>

                    <form action="{{ route('stripe.payment.process') }}" method="post" id="payment-form">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        
                        <div class="form-row">
                            <label for="card-element" class="form-label">
                                ক্রেডিট অথবা ডেবিট কার্ড
                            </label>
                            <div id="card-element" class="form-control">
                              <!-- A Stripe Element will be inserted here. -->
                            </div>
                        
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button class="btn btn-primary">
                                পেমেন্ট করুন
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // আপনার পাবলিক স্ট্রাইপ কী এখানে বসান
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#32325d',
        },
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
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

</body>
</html>