<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->invoice_no }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* --- THIS MAKES THE INVOICE CONTAINER A REFERENCE FOR POSITIONING --- */
        .invoice-container {
            position: relative; /* This is the key change */
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            padding-bottom: 80px; /* Add extra padding at the bottom for the button */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .invoice-header .display-4 { font-weight: 700; color: #343a40; }
        .invoice-details p { margin-bottom: 0.5rem; }
        .billed-to { margin-top: 3rem; margin-bottom: 2rem; }
        .table thead th { background-color: #f8f9fa; border-bottom-width: 2px; }
        .table tfoot td { font-weight: bold; }
        .payment-details { margin-top: 2rem; }
        .invoice-footer { margin-top: 3rem; border-top: 1px solid #dee2e6; padding-top: 1.5rem; }

        /* --- THIS IS THE CSS FOR THE PRINT BUTTON INSIDE THE INVOICE --- */
        .invoice-actions {
            position: absolute; /* Positions the button relative to .invoice-container */
            bottom: 40px;       /* 40px from the bottom edge of the invoice */
            right: 40px;        /* 40px from the right edge of the invoice */
        }

        @media print {
            body { background-color: #fff; }
            .invoice-container {
                box-shadow: none; margin: 0; max-width: 100%; border-radius: 0; padding: 10px;
            }
            .invoice-actions { 
                display: none; /* Hide the button when printing */
            }
        }
    </style>
</head>
<body>

<!-- The main invoice container -->
<div class="invoice-container">
    
    <!-- Header Section -->
    <header class="row invoice-header">
        <div class="col-6"><h1 class="display-4">INVOICE</h1><p class="text-muted">MiM SHOP</p></div>
        <div class="col-6 text-end invoice-details"><p><strong>Invoice #:</strong> {{ $order->invoice_no }}</p><p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p><p><strong>Status:</strong> <span class="badge {{ $order->status == 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $order->status }}</span></p></div>
    </header>
    <hr>
    
    <!-- Billed To Section -->
    <section class="billed-to"><h5 class="fw-semibold">Billed To:</h5><p class="mb-0">{{ $order->user->name }}</p><p>{{ $order->user->email }}</p></section>
    
    <!-- Invoice Table -->
    <section>
        <table class="table table-bordered">
            <thead class="table-light"><tr><th scope="col" class="py-2">Description</th><th scope="col" class="text-end py-2">Amount</th></tr></thead>
            <tbody><tr><td class="py-2">Payment for Invoice #{{ $order->invoice_no }}</td><td class="text-end py-2">@if(strtoupper($order->payment_method) == 'STRIPE')USD {{ number_format($order->amount, 2) }}@else BDT {{ number_format($order->amount, 2) }}@endif</td></tr></tbody>
            <tfoot><tr><td class="text-end py-2"><strong>Grand Total</strong></td><td class="text-end py-2"><strong>@if(strtoupper($order->payment_method) == 'STRIPE')USD {{ number_format($order->amount, 2) }}@else BDT {{ number_format($order->amount, 2) }}@endif</strong></td></tr></tfoot>
        </table>
    </section>
    
    <!-- Payment Details -->
  <section class="payment-details">

    {{-- শুধুমাত্র পেমেন্ট মেথড সেট করা থাকলেই এই অংশটি দেখাবে --}}
   
    @if($order->payment_method)

        <p>
          <strong>Payment Method:</strong> 
            @if($order->payment_method === 'Stripe')
                Credit/Debit Card
            @elseif($order->payment_method === 'bKash')
                bKash
            @else
                {{ $order->payment_method }} {{-- অন্য কোনো মেথড (যেমন COD, Bank) থাকলে সেটি দেখাবে --}}
            @endif
        </p>

        {{-- পেমেন্ট আইডি বা ট্রানজেকশন আইডি দেখানোর জন্য --}}
        
        @if($order->payment_method === 'Stripe')
            {{-- স্ট্রাইপের ক্ষেত্রে Payment ID দেখাবে --}}
            <p><strong>Payment ID:</strong> {{ $order->payment_id ?? 'N/A' }}</p>

        @elseif($order->payment_method === 'bKash')
            {{-- বিকাশের ক্ষেত্রে Transaction ID দেখাবে --}}
            <p><strong>Transaction ID:</strong> {{ $order->trx_id ?? 'N/A' }}</p>
        
        @endif
        {{-- অন্য কোনো পেমেন্ট মেথডের জন্য আইডি দেখানোর প্রয়োজন হলে এখানে @elseif যোগ করা যাবে --}}

    @endif

</section>
    
    <!-- Footer -->
    <footer class="invoice-footer text-center"><p class="text-muted">Thank you for your business!</p></footer>

    <!-- Print Button - Placed inside the main invoice container -->
    <div class="invoice-actions">
        <!-- Download Button -->
        <a href="{{ route('order.download', $order->id) }}" class="btn btn-secondary">
            <i class="bi bi-download me-1"></i> Download
        </a>
        <!-- Print Button -->
        <button class="btn btn-primary" onclick="window.print();">
            <i class="bi bi-printer me-1"></i> Print
        </button>
    </div>
  </div>
</body>
</html>