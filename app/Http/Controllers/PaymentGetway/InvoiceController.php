<?php

namespace App\Http\Controllers\PaymentGetway;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF; // Import the PDF facade

class InvoiceController extends Controller
{
    public function orderSuccess($order_id)
    {
        // Eager load the 'user' relationship
        $order = Order::with('user')->findOrFail($order_id);

        // Security check
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('invoice.success', compact('order'));
    }

    // --- ADD THIS NEW METHOD ---
    public function downloadPDF($order_id)
    {
        // Find the order and perform the same security check
        $order = Order::with('user')->findOrFail($order_id);
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // We need a separate, simpler view for the PDF without buttons or complex styles
        $pdf = PDF::loadView('invoice.pdf_view', compact('order'));

        // Set a filename for the download
        $fileName = $order->invoice_no . '.pdf';
        
        // Return the PDF as a download
        return $pdf->download($fileName);
    }
}