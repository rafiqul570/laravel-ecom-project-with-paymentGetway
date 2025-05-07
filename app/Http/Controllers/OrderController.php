<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;
use PDF;

class OrderController extends Controller
{
     public function index(){

        $order = Order::all();
        return view('admin.order.index', compact('order'));
     }


     public function store(Request $request){

         $shippingAddress = Checkout::where('user_id', auth()->id())->first();
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
        Checkout::where('user_id', auth()->id())->delete();
      }
        

    return redirect()->route('front.pages.pendingOrders')->with('success', 'Success! data insert Successfully');

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
