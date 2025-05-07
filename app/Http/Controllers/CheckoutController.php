<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index(){

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');
        
        $total = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;
        
        $shippingAddress = Checkout::where('user_id', auth()->id())->limit(1)->get(); //LIMIT

        return view('front.checkout.index', compact('cartItems', 'shippingCost', 'total', 'grand_total', 'shippingAddress'));
    }


    public function create(){

        $cartItems = Cart::where('user_id', auth()->id())->get();

        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');

        $subtotal = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);
        
        $total = $subtotal + $shippingCost;

        return view('front.checkout.create', compact('cartItems','subtotal', 'shippingCost', 'total'));
    }


    public function store(Request $request){


        Checkout::insert([
            'user_id' => Auth::id(),
            'city' => $request->city,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            
        ]);


    return redirect()->route('front.checkout.index')->with('success', 'Success! data insert Successfully');

    }


}
