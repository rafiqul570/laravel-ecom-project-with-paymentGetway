<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বিকাশ পেমেন্ট</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS for a better look and feel -->
    <style>
        body { 
            background-color: #f1f5f9;
        }
        .payment-card {
            max-width: 450px;
            width: 100%;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            /* মার্জিন এখন বুটস্ট্র্যাপ ক্লাস দিয়ে নিয়ন্ত্রণ করা হবে */
        }
        .card-header { 
            background-color: white; 
            border-bottom: 1px solid #e2e8f0; 
            padding-top: 2rem;
            padding-bottom: 1rem;
        }
        .bkash-logo { 
            max-width: 120px; 
            margin-bottom: 1rem;
        }
        .btn-bkash {
            background-color: #e2136e;
            color: white;
            font-weight: bold;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.85rem;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }
        .btn-bkash:hover { 
            background-color: #c0105c; 
            color: white; 
        }
        .payment-details span {
            color: #64748b;
        }
    </style>
</head>
<body>

    {{-- এই কন্টেইনারটিকে সেন্টারে আনা হয়েছে --}}
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="payment-card">
            <div class="card-header text-center">
                <img src="{{asset('images/bkash-logo.jpg')}}" alt="bKash Logo" class="bkash-logo">
                <h4 class="fw-bold mb-3">বিকাশের মাধ্যমে পেমেন্ট করুন</h4>
            </div>

            <div class="card-body p-4">
                <div class="payment-details mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>ইনভয়েস নং:</span>
                        <strong class="text-dark">{{ $order->invoice_no }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>পরিশোধের পরিমাণ:</span>
                        <strong class="text-dark fs-5">৳ {{ number_format($order->amount, 2) }}</strong>
                    </div>
                </div>

                <hr class="my-4">

                @if(session('error-alert2'))
                    <div class="alert alert-danger text-center">
                        <strong>ত্রুটি:</strong> {{ session('error-alert2') }}
                    </div>
                @endif

                <form action="{{ route('bkash.create-payment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <div class="d-grid">
                        <button type="submit" id="bKash_button" class="btn btn-bkash">
                            পেমেন্ট করতে এগিয়ে যান
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center bg-light border-top-0 py-3">
                <small class="text-muted">আপনাকে নিরাপদ বিকাশ পেমেন্ট পেজে নিয়ে যাওয়া হবে।</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>