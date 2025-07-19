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
use DB;
class OrderController extends Controller
{
    /**
     * ধাপ ১: কার্ট থেকে অর্ডার প্রক্রিয়া শুরু করা
     * এটি একটি পেন্ডিং অর্ডার তৈরি করে এবং পেমেন্ট অপশন পেজে রিডাইরেক্ট করে।
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction(); // ডাটাবেস ট্রানজেকশন শুরু

        try {
            // --- সমাধান ১: ডাইনামিক শিপিং খরচ গণনা ---
            // CartController-এর মতো একই লজিক এখানে ব্যবহার করা হলো।
            $subtotal = $cartItems->sum(function($item) {
                $price = $item->discount_price > 0 ? $item->discount_price : $item->product_price;
                return $price * $item->product_quantity;
            });

            $shippingCost = ($subtotal >= 5000) ? 0 : 120; // ৫০০০ বা তার বেশি হলে ফ্রি শিপিং
            $grandTotal = $subtotal + $shippingCost;

            // প্রথমে একটি পেন্ডিং অর্ডার তৈরি করুন
            $order = Order::create([
                'invoice_no'        => 'INV-' . strtoupper(uniqid()),
                'user_id'           => $user->id,
                'amount'            => $grandTotal, // সঠিক গ্র্যান্ড টোটাল
                'status'            => 'pending', // অর্ডারের প্রাথমিক স্ট্যাটাস
                'payment_method'    => null, // এখনো নির্বাচিত হয়নি
            ]);

            // অর্ডার আইটেমগুলো যোগ করুন
            foreach ($cartItems as $item) {
                // --- সমাধান ২: সঠিক কলামের নাম ব্যবহার ---
                // মাইগ্রেশন অনুযায়ী `quantity` এবং `price` ব্যবহার করা হলো।
                $unitPrice = $item->discount_price > 0 ? $item->discount_price : $item->product_price;

                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->product_id,
                    'product_name'  => $item->product_name,
                    'product_img'   => $item->product_img,
                    'product_color' => $item->product_color,
                    'product_size'  => $item->product_size,
                    'quantity'      => $item->product_quantity,
                    'price'         => $unitPrice, 
                    'total_price'   => $item->total_price,
                ]);
            }

            // অর্ডার তৈরির পর কার্ট খালি করুন
            Cart::where('user_id', $user->id)->delete();

            DB::commit(); // সবকিছু ঠিক থাকলে ডাটাবেসে সেভ করুন

            // অর্ডার আইডি সহ পেমেন্ট অপশন পেজে রিডাইরেক্ট করুন
            return redirect()->route('payment.options', ['order_id' => $order->id]);

        } catch (Exception $e) {
            DB::rollBack(); // কোনো সমস্যা হলে আগের অবস্থায় ফিরে যান
            // আপনি চাইলে এরর লগ করতে পারেন: Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while placing the order. Please try again.');
        }
    }

    /**
     * ধাপ ২: পেমেন্ট অপশন পেজ দেখানো/Payment option/me page load
     */
    public function showPaymentOptions($order_id)
    
    {
        // 'items' রিলেশনশিপসহ অর্ডারটি লোড করুন যাতে অতিরিক্ত কোয়েরি করতে না হয়
        $order = Order::with('items')->findOrFail($order_id);

        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
            return redirect()->route('home')->with('error', 'This order is not accessible or has already been processed.');
        }

        // ১. সাব-টোটাল গণনা করুন (অর্ডারের আইটেমগুলোর মোট মূল্য যোগ করে)
        $subtotal = $order->items->sum('total_price');

        // ২. গ্র্যান্ড টোটাল হলো অর্ডারের মোট অ্যামাউন্ট
        $grand_total = $order->amount;

        // ৩. শিপিং খরচ গণনা করুন (গ্র্যান্ড টোটাল থেকে সাব-টোটাল বিয়োগ করে)
        $shippingCost = $grand_total - $subtotal;

        // ৪. প্রয়োজনীয় সব ভ্যারিয়েবল ভিউতে পাঠান
        return view('payment', [
            'order'         => $order,
            'total'         => $subtotal, // ব্লেড ফাইলে সাব-টোটালের জন্য 'total' ব্যবহার করা হয়েছে
            'shippingCost'  => $shippingCost,
            'grand_total'   => $grand_total,
        ]);
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
        
        if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
             return redirect()->route('home')->with('error', 'This order cannot be processed.');
        }
        
        $paymentMethod = $request->input('payment_method');
        $order->payment_method = $paymentMethod; // পেমেন্ট পদ্ধতি সেভ করা

        switch ($paymentMethod) {
            case 'cod':
                // --- সমাধান ৩: সঠিক আপডেট ---
                $order->status = 'processing'; // অর্ডারের স্ট্যাটাস 'processing' হবে
                $order->save();
                // সফলতার পেজে রিডাইরেক্ট
                return redirect()->route('order.success', ['order_id' => $order->id])
                       ->with('success', 'Your order has been placed successfully!');

            case 'bank':
                $order->status = 'on-hold'; // পেমেন্টের অপেক্ষায়
                $order->save();
                 // সফলতার পেজে একটি বিশেষ বার্তা সহ রিডাইরেক্ট
                return redirect()->route('order.success', ['order_id' => $order->id])
                       ->with('info', 'Your order is on hold. Please follow bank payment instructions.');

            case 'bkash':
                $order->save(); // পেমেন্ট মেথড সেভ করে গেটওয়েতে পাঠানো
                return redirect()->route('paymentGetway.bkash.payment', ['order_id' => $order->id]);
            
            case 'stripe':
                $order->save(); // পেমেন্ট মেথড সেভ করে গেটওয়েতে পাঠানো
                return redirect()->route('stripe.payment.form', ['order_id' => $order->id]);
        }

        return redirect()->back()->with('error', 'Invalid payment method selected.');
    }
    
    /**
     * ধাপ ৪: সফলতার পেজ দেখানো
     */
    public function orderSuccess($order_id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($order_id);

        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('front.order-success', compact('order'));
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