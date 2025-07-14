<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Billing;
use App\Models\Order;


class BillingController extends Controller
{
    public function shippingAddress(){

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');
        
        $total = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;
        
        $shippingAddress = Billing::where('user_id', auth()->id())->limit(1)->get(); //LIMIT

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
