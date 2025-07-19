<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shippingcost;
use App\Models\Cart;
use App\Models\Billing;

class ShippingController extends Controller
{
    public function index(){
        $shippingCost = Shippingcost::latest()->get();
        return view('admin.shippingcost.index', compact('shippingCost'));
    }

    public function create(){
        return view('admin.shippingcost.create');
    }


 public function store(Request $request)
    {
        $request->validate([
            'shippingcost' => 'required',
        ]);

        Shippingcost::create([
            'shippingcost' => $request->shippingcost,
        ]);

        return back()->with('success', 'Success! data insert Successfully');
    }


    public function edit($id){
        $editCategory = Shippingcost::FindOrFail($id);

        return view('admin.shippingcost.edit', compact('editCategory'));

    }

    public function update(Request $request){
        $id = $request->id;

        $request->validate([
            'shippingcost' => 'required',
        ]);

        Shippingcost::FindOrFail($id)->update([
            'shippingcost' => $request->category_name,
            
        ]);


        return redirect()->route('admin.shippingcost.index')->with('success', 'Success! data update Successfully');

    }

    public function delete($id){
        Shippingcost::FindOrFail($id)->delete();
        return back()->with('success', 'Success! data delete Successfully');
    }




    public function shippingInfo(){

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        
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

        $grand_total = $total + $shippingCost;
        
        $shippingAddress = Billing::where('user_id', auth()->id())->limit(1)->get(); //LIMIT

        return view('shipping', compact('cartItems', 'shippingCost', 'total', 'grand_total', 'shippingAddress'));
    }

}
