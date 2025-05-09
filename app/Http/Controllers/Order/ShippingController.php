<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Billing;
use App\Models\Order;

class ShippingController extends Controller
{
    public function shippingInfo(){

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');
        
        $total = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;
        
        $shippingAddress = Billing::where('user_id', auth()->id())->limit(1)->get(); //LIMIT

        return view('shipping', compact('cartItems', 'shippingCost', 'total', 'grand_total', 'shippingAddress'));
    }

}
