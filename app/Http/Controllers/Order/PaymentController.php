<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Billing;
use App\Models\Order;

class PaymentController extends Controller
{
     public function paymentMethod(){
        
        $paymentMethod = Cart::where('user_id', auth()->id())->get();

        //$cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        $shippingCost = Cart::where('user_id', auth()->id())->value('shippingCost');
        
        $total = $paymentMethod->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;

        return view('payment', compact( 'paymentMethod', 'grand_total'));
    }

}
