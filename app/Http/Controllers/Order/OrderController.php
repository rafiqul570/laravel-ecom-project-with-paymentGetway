<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Validation\Rule; // Rule facade যোগ করা হলো
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;
use Exception; // Exception ক্লাস যোগ করা হলো

class OrderController extends Controller
{
    // =====================================================================
    //  অর্ডার এবং পেমেন্ট ফ্লো (আপনার প্রধান পরিবর্তন এখানে)
    // =====================================================================

    /**
     * ধাপ ১: কার্ট থেকে অর্ডার প্রক্রিয়া শুরু করা
     * আপনার পুরনো store() মেথডের উন্নত সংস্করণ।
     * এটি একটি পেন্ডিং অর্ডার তৈরি করে এবং পেমেন্ট অপশন পেজে রিডাইরেক্ট করে।
     */
    public function store(Request $request) // মেথডের নাম পরিবর্তন করা হলো
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'আপনার কার্ট খালি।');
        }

        try {
            $shippingCost = 120; // আপনি এটি ডাইনামিকভাবে পরিবর্তন করতে পারেন
            $totalAmount = $cartItems->sum('total_price') + $shippingCost;

            // প্রথমে একটি পেন্ডিং অর্ডার তৈরি করুন
            $order = Order::create([
                'invoice_no'        => 'INV-' . strtoupper(uniqid()),
                'user_id'           => $user->id,
                'amount'            => $totalAmount,
                'status'            => 'pending', // ডাটাবেসে 
                'payment_method'    => null,
            ]);

            // অর্ডার আইটেমগুলো যোগ করুন
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'          => $order->id,
                    'product_id'        => $item->product_id,
                    'product_name'      => $item->product_name,
                    'product_color'     => $item->product_color,
                    'product_size'      => $item->product_size,
                    'product_quantity'  => $item->product_quantity,
                    'product_price'     => $item->product_price,
                    'total_price'       => $item->total_price,
                    'product_img'       => $item->product_img,
                ]);
            }

            // অর্ডার তৈরির পর কার্ট খালি করুন
            Cart::where('user_id', $user->id)->delete();

            // অর্ডার আইডি সহ পেমেন্ট অপশন পেজে রিডাইরেক্ট করুন
            return redirect()->route('payment.options', ['order_id' => $order->id]);

        } catch (Exception $e) {
            // Log::error($e->getMessage()); // আপনি চাইলে লগ করতে পারেন
            return redirect()->back()->with('error', 'অর্ডার তৈরিতে একটি সমস্যা হয়েছে।');
        }
    }

    /**
     * ধাপ ২: পেমেন্ট অপশন পেজ দেখানো
     * এই মেথডটি ব্যবহারকারীকে পেমেন্ট মেথড বেছে নেওয়ার পেজটি দেখায়।
     */
    public function showPaymentOptions($order_id)
    {
        $order = Order::findOrFail($order_id);

        if ($order->user_id !== Auth::id() || trim(strtolower($order->status)) !== 'pending') {
            abort(403, 'Unauthorized or invalid order.');
        }

        return view('paymentGetway.paymentOptions', compact('order'));
    }

    /**
     * ধাপ ৩: ব্যবহারকারীর বেছে নেওয়া পেমেন্ট মেথড প্রসেস করা
     */
    public function processSelection(Request $request, $order_id)
    {
        $request->validate([
            'payment_method' => ['required', Rule::in(['cod', 'bkash', 'stripe', 'bank'])],
        ]);

        $order = Order::findOrFail($order_id);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        $paymentMethod = $request->input('payment_method');

        switch ($paymentMethod) {
            case 'cod':
                $order->update([
                    'status' => 'processing', 
                    'status' => 'processing',
                    'payment_method' => 'Cash on Delivery'
                ]);
                return redirect()->route('order.success', ['order_id' => $order->id]);

            case 'bkash':
                // আপনাকে এই রাউটগুলো তৈরি করতে হবে
                return redirect()->route('bkash.payment', ['order_id' => $order->id]);
            
            case 'stripe':
                // আপনাকে এই রাউটগুলো তৈরি করতে হবে
                return redirect()->route('stripe.payment.form', ['order_id' => $order->id]);

            case 'bank':
                $order->update([
                    'status' => 'awaiting_bank_payment', 
                    'payment_method' => 'Bank Transfer'
                ]);
                return redirect()->route('order.success', ['order_id' => $order->id]);
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
    
    /**
     * ধাপ ৪: সফলতার পেজ দেখানো
     * আপনার পুরনো orders_confurm() মেথডের উন্নত সংস্করণ।
     */
    public function orderSuccess($order_id)
    {
        $order = Order::with('user', 'items')->findOrFail($order_id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // এখানে আপনি আপনার thankyou ভিউ ফাইলটি ব্যবহার করতে পারেন
        return view('order.success', compact('order'));
    }


    // =====================================================================
    //  আপনার পুরনো অন্যান্য মেথডগুলো (অপরিবর্তিত)
    // =====================================================================

    public function order(){
        $order = Order::latest()->get();
        return view('admin.order', compact('order'));
    }

    public function pendingOrders(){
        $pendingOrders = Order::where('user_id', auth()->id())->get();
        // ... আপনার বাকি লজিক ...
        return view('pendingOrders', compact( 'pendingOrders' /*, ... */));
    }

    public function delivered($id){
        $order = Order::findOrFail($id);
        $order->status = "delivered";
        $order->status = "PAID";
        $order->save();
        return redirect()->back();
    }
    

    public function send_email($id){
        // ... আপনার কোড ...
    }

    public function send_user_email(Request $request, $id){
        // ... আপনার কোড ...
    }
}