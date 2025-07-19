<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Billing;



class BillingController extends Controller
{
      /**
     * Display the billing page and calculate totals with conditional shipping.
     */
    public function shippingAddress()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('info', 'Your cart is empty.');
        }

        // --- ধাপ ১: প্রথমে কার্টের সকল পণ্যের সাব-টোটাল বের করুন ---
        // এই কোডটি ডিসকাউন্ট প্রাইস চেক করে সঠিক সাব-টোটাল গণনা করবে।
        $total = $cartItems->sum(function ($item) {
            $priceToUse = $item->discount_price > 0 ? $item->discount_price : $item->product_price;
            return $priceToUse * $item->product_quantity;
        });


        // --- ধাপ ২: শিপিং খরচের নিয়মটি এখানে প্রয়োগ করুন ---
        $shippingCost = 0; // ডিফল্টভাবে শিপিং খরচ ০ ধরে নিলাম

        // একটি স্ট্যান্ডার্ড শিপিং খরচ নির্ধারণ করুন (যদি ফ্রি না হয়)। আপনি এই মান পরিবর্তন করতে পারেন।
        $standardShippingCost = 120; 

        // এখন চেক করুন মোট মূল্য (সাব-টোটাল) ৫০০০ টাকার বেশি কিনা
        if ($total > 5000) {
            
            $shippingCost = 0; // সাব-টোটাল ৫০০০ টাকার বেশি হলে শিপিং খরচ ০
       
        } else {
            
            $shippingCost = $standardShippingCost; // অন্যথায় স্ট্যান্ডার্ড শিপিং খরচ প্রযোজ্য হবে
        }
        

        // --- ধাপ ৩: চূড়ান্ত মোট বা গ্র্যান্ড টোটাল গণনা করুন ---
        $grand_total = $total + $shippingCost;
        
        $shippingAddress = Billing::where('user_id', auth()->id())->latest()->first();

        // সকল সঠিক তথ্যসহ ভিউ ফাইলটি রিটার্ন করুন
        return view('billing', compact('cartItems', 'shippingCost', 'total', 'grand_total', 'shippingAddress'));
    }


    public function create(){

        $cartItems = Cart::where('user_id', auth()->id())->get();

        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');

        $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);
        
        $total = $subtotal + $shippingCost;

        return view('billing.create', compact('cartItems','subtotal', 'shippingCost', 'total'));
    }


    public function store(Request $request){


        Billing::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            
        ]);


    return redirect()->route('shipping')->with('success', 'Success! data insert Successfully');

    }
}
