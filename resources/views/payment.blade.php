@include('front.inc.mollaHeader')

{{-- Custom styles for image-based radio button selection --}}
<style>
    /* Hide the actual radio button */
    .payment-option input[type="radio"] {
        display: none;
    }

    /* Style the container for the payment options */
    .payment-method-image-select {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem; /* Space between the images */
    }

    /* Style the images */
    .payment-option img {
        width: 120px;
        height: 75px;
        border: 3px solid #e9e9e9;
        border-radius: 8px;
        cursor: pointer;
        transition: border-color 0.2s ease-in-out, transform 0.2s ease-in-out;
        object-fit: contain; /* Ensures logos fit well without distortion */
        padding: 5px;
        background-color: #fff;
    }

    /* Style the image on hover */
    .payment-option img:hover {
        border-color: #c0c0c0;
    }

    /* Style for the selected image */
    .payment-option input[type="radio"]:checked + img {
        border-color: #0d6efd; /* Bootstrap primary color for selection */
        transform: scale(1.05); /* Slightly enlarge the selected image */
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);
    }
</style>

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shipping') }}">Shipping</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="{{ route('payment.process.selection', ['order_id' => $order->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body p-4">
                                    <h2 class="card-title h5 mb-4" style="font-size: 20px;">Select Payment Method</h2>
                                    
                                    <div class="payment-method-image-select">
                                        <!-- Cash on Delivery -->
                                        <div class="payment-option">
                                            <label for="cod">
                                                <input type="radio" name="payment_method" id="cod" value="cod" checked>
                                                {{-- Replace with your actual image path --}}
                                                <img src="https://placehold.co/120x75/f0f0f0/333?text=Cash+on\nDelivery" alt="Cash on Delivery">
                                            </label>
                                        </div>
                                        
                                        <!-- bKash -->
                                        <div class="payment-option">
                                            <label for="bkash">
                                                <input type="radio" name="payment_method" id="bkash" value="bkash">
                                                {{-- Replace with your actual image path --}}
                                                <img src="https://placehold.co/120x75/E2136E/white?text=bKash" alt="bKash">
                                            </label>
                                        </div>

                                        <!-- Visa/Mastercard -->
                                        <div class="payment-option">
                                            <label for="stripe">
                                                <input type="radio" name="payment_method" id="stripe" value="stripe">
                                                 {{-- Replace with your actual image path --}}
                                                <img src="https://placehold.co/120x75/635BFF/white?text=Cards" alt="Visa / Mastercard">
                                            </label>
                                        </div>

                                        <!-- Bank Payment / Payoneer -->
                                        <div class="payment-option">
                                            <label for="bank">
                                                <input type="radio" name="payment_method" id="bank" value="bank">
                                                 {{-- Replace with your actual image path --}}
                                                <img src="https://placehold.co/120x75/0073CF/white?text=Bank" alt="Bank Transfer / Payoneer">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <aside class="col-lg-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <h3 class="summary-title h5">Order Summary</h3>
                                    
                                    <table class="table table-summary">
                                        <tbody>
                                            <tr class="summary-subtotal">
                                                <td>Subtotal</td>
                                                <td>$ {{ number_format($total ?? 0, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td>$ {{ number_format($shippingCost ?? 0, 2) }}</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td><strong>Total</strong></td>
                                                <td><strong>$ {{ number_format($grand_total ?? 0, 2) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-order text-dark btn-block">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


@include('front.inc.mollaFooter')
