<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Session; // Session facade ব্যবহার না হলে এটি মুছে ফেলা যায়।

class StripePaymentController extends Controller
{
    /**
     * স্ট্রাইপ পেমেন্ট ফর্ম দেখানোর জন্য।
     */
    public function showPaymentForm($order_id)
    {
        $order = Order::findOrFail($order_id);
        
        // --- সুপারিশকৃত পরিবর্তন ---
        // স্ট্যাটাস চেককে case-insensitive করা হলো
        if ($order->user_id !== Auth::id() || trim(strtolower($order->status)) !== 'pending') {
            abort(403, 'Unauthorized or invalid order.');
        }
        
        return view('paymentGetway.stripe.Payment', compact('order'));
    }

    /**
     * স্ট্রাইপ পেমেন্ট প্রসেস করার জন্য।
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'stripeToken' => 'required',
            'order_id' => 'required|exists:orders,id'
        ]);
        
        $order = Order::findOrFail($request->order_id);
        
        // --- সুপারিশকৃত পরিবর্তন ---
        if ($order->user_id !== Auth::id() || trim(strtolower($order->status)) !== 'pending') {
            return back()->with('error', 'Invalid Request.');
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Stripe\Charge::create([
                "amount"      => $order->amount * 100, // Amount in cents
                "currency"    => "usd", // আপনি চাইলে bdt ব্যবহার করতে পারেন যদি স্ট্রাইপ সাপোর্ট করে
                "source"      => $request->stripeToken,
                "description" => "Payment for Invoice #" . $order->invoice_no,
            ]);

            $order->update([
                'status'         => 'Paid',
                'payment_method' => 'Stripe',
                'payment_id'     => $charge->id,
            ]);
            
            // সফল পেমেন্টের পর সাকসেস পেজে রিডাইরেক্ট করুন
            return redirect()->route('order.success', ['order_id' => $order->id]);

        } catch (\Exception $e) {
            // আরও বিস্তারিত ত্রুটির বার্তার জন্য
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}