<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Billing;
use App\Models\Order;
use PDF;

class OrderController extends Controller
{
    public function orderDelivered(){

        $order = Order::all();
        return view('admin.orderDelivered', compact('order'));
     }


    public function pendingOrders(){

        $pendingOrders = Order::where('user_id', auth()->id())->get();
        
        $shippingCost = Order::where('user_id', auth()->id())->value('shippingCost');
        
        $total = $pendingOrders->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;

        return view('pendingOrders', compact( 'pendingOrders', 'shippingCost', 'total', 'grand_total'));
    }



    public function store(Request $request){

         $shippingAddress = Billing::where('user_id', auth()->id())->first();
         $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        foreach($cartItems as $item){
        Order::insert([
            'user_id' => Auth::id(),
            'city' => $shippingAddress->city,
            'postcode' => $shippingAddress->postcode,
            'phone' => $shippingAddress->phone,

            'product_id' => $item->product_id,
            'product_name' => $item->product_name,
            'product_color' => $item->product_color,
            'product_size' => $item->product_size,
            'product_img' => $item->product_img,
            'product_quantity' => $item->product_quantity,
            'product_price' => $item->product_price,
            'shippingCost' => $item->shippingCost,
            'total_price' => $item->total_price,
            
            'payment_status' => 'cash on delivery',
            'delivery_status' => 'processing',
            
        ]);

        Cart::where('user_id', auth()->id())->delete();
        Billing::where('user_id', auth()->id())->delete();
      }
        

    return redirect()->route('pendingOrders')->with('success', 'Success! data insert Successfully');

    }

    public function delivered($id){

        $orders = Order::FindOrFail($id);
        $orders->delivery_status = "delivered";
        $orders->payment_status = "PAID";
        $orders->save();
        return redirect()->back();

    }

    
    // Download PDF
    
    public function print_pdf($id){

        $order= Order::FindOrFail($id);

        $pdf = PDF::loadView('admin.pdf.invoice', compact('order'));

        return $pdf->download('order_details.pdf');
    }





}
