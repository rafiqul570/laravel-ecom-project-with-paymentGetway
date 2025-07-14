<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->invoice_no }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 14px; color: #333; }
        .invoice-container { width: 100%; margin: 0 auto; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .mb-0 { margin-bottom: 0; }
        .mb-1 { margin-bottom: 0.25rem; }
        .mt-4 { margin-top: 1.5rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .w-100 { width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; }
        th { background-color: #f8f8f8; }
        .badge { display: inline-block; padding: .35em .65em; font-size: .75em; font-weight: 700; line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: .25rem; }
        .bg-success { background-color: #198754; }
        .bg-warning { background-color: #ffc107; color: #000; }
        hr { border: 0; border-top: 1px solid #eee; margin: 1rem 0; }
    </style>
</head>
<body>
<div class="invoice-container">
    <table class="w-100" style="border: none;">
        <tr style="border: none;">
            <td style="width: 50%; border: none;">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">INVOICE</h1>
                <p style="color: #6c757d; margin-top: 5px;">MiM SHOP</p>
            </td>
            <td style="width: 50%; text-align: right; border: none;">
                <p class="mb-1"><strong>Invoice #:</strong> {{ $order->invoice_no }}</p>
                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                <p class="mb-0"><strong>Status:</strong> <span class="badge {{ $order->status == 'Paid' ? 'bg-success' : 'bg-warning' }}">{{ $order->status }}</span></p>
            </td>
        </tr>
    </table>
    <hr>
    <div style="margin-top: 2rem; margin-bottom: 2rem;">
        <h5 style="font-weight: 600;">Billed To:</h5>
        <p class="mb-0">{{ $order->user->name }}</p>
        <p class="mb-0">{{ $order->user->email }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th class="py-2">Description</th>
                <th class="text-end py-2">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="py-2">Payment for Invoice #{{ $order->invoice_no }}</td>
                <td class="text-end py-2">@if(strtoupper($order->payment_method) == 'STRIPE')USD {{ number_format($order->amount, 2) }}@else BDT {{ number_format($order->amount, 2) }}@endif</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end py-2 fw-bold">Grand Total</td>
                <td class="text-end py-2 fw-bold">@if(strtoupper($order->payment_method) == 'STRIPE')USD {{ number_format($order->amount, 2) }}@else BDT {{ number_format($order->amount, 2) }}@endif</td>
            </tr>
        </tfoot>
    </table>
    <div class="mt-4">
        @if($order->payment_method)
            <p class="mb-1"><strong>Payment Method:</strong> {{ $order->payment_method == 'Stripe' ? 'Credit/Debit Card' : 'bKash' }}</p>
            @if($order->payment_method == 'Stripe')
                <p class="mb-1"><strong>Payment ID:</strong> {{ $order->payment_id ?? 'N/A' }}</p>
            @else
                <p class="mb-1"><strong>Transaction ID:</strong> {{ $order->trx_id ?? 'N/A' }}</p>
            @endif
        @endif
    </div>
    <div class="text-center" style="margin-top: 3rem; border-top: 1px solid #eee; padding-top: 1.5rem;">
        <p style="color: #6c757d;">Thank you for your business!</p>
    </div>
</div>
</body>
</html>