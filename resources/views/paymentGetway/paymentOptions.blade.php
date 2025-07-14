<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>পেমেন্ট মেথড বেছে নিন</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .payment-option-label {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 1px solid #dee2e6;
        border-radius: .375rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .payment-option-label:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
    }
    .payment-option input[type="radio"]:checked + .payment-option-label {
        background-color: #e9f5ff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
    }
    .payment-option input[type="radio"] {
        display: none;
    }
    .payment-option-label img {
        height: 40px;
        margin-right: 1rem;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-md-9">
      <div class="card shadow-sm">
        <div class="card-header text-center bg-light">
            <h3 class="mb-0">পেমেন্ট সম্পন্ন করুন</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <span>ইনভয়েস নং:</span>
                <strong>{{ $order->invoice_no }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span>পরিশোধের পরিমাণ:</span>
                <strong class="h4">৳ {{ number_format($order->amount, 2) }}</strong>
            </div>

            <h5 class="mb-3">আপনার পেমেন্ট মেথড বেছে নিন:</h5>

            <!-- পেমেন্ট মেথড বেছে নেওয়ার ফর্ম -->
            <form action="{{ route('payment.process.selection', ['order_id' => $order->id]) }}" method="POST">
                @csrf
                
                <!-- ক্যাশ অন ডেলিভারি -->
                <div class="payment-option">
                    <input type="radio" id="cod" name="payment_method" value="cod">
                    <label for="cod" class="payment-option-label">
                        <img src="https://i.ibb.co/pWSR1xP/cod.png" alt="Cash on Delivery">
                        <div>
                            <span class="fw-bold d-block">ক্যাশ অন ডেলিভারি</span>
                            <small class="text-muted">প্রোডাক্ট হাতে পেয়ে পেমেন্ট করুন</small>
                        </div>
                    </label>
                </div>
                
                <!-- বিকাশ -->
                <div class="payment-option">
                    <input type="radio" id="bkash" name="payment_method" value="bkash" checked>
                    <label for="bkash" class="payment-option-label">
                        <img src="{{ asset('images/bKash.jpg') }}" alt="bKash">
                         <div>
                            <span class="fw-bold d-block">বিকাশ</span>
                            <small class="text-muted">বিকাশ দিয়ে নিরাপদে পেমেন্ট করুন</small>
                        </div>
                    </label>
                </div>

                <!-- ভিসা/মাস্টার কার্ড -->
                <div class="payment-option">
                    <input type="radio" id="stripe" name="payment_method" value="stripe">
                    <label for="stripe" class="payment-option-label">
                        <img src="https://i.ibb.co/Yj2jWk6/card.png" alt="Card Payment">
                        <div>
                            <span class="fw-bold d-block">ভিসা / মাস্টার কার্ড</span>
                            <small class="text-muted">Stripe এর মাধ্যমে পেমেন্ট করুন</small>
                        </div>
                    </label>
                </div>

                <!-- ব্যাংক পেমেন্ট -->
                <div class="payment-option">
                    <input type="radio" id="bank" name="payment_method" value="bank">
                    <label for="bank" class="payment-option-label">
                        <img src="https://i.ibb.co/3kCj9fr/bank.png" alt="Bank Payment">
                        <div>
                            <span class="fw-bold d-block">ব্যাংক পেমেন্ট</span>
                            <small class="text-muted">সরাসরি ব্যাংক ট্রান্সফার করুন</small>
                        </div>
                    </label>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">পরবর্তী ধাপে যান</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>