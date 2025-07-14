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

        $shippingCost = Cart::with('product')->where('user_id', auth()->id())->value('shippingCost');
        
        $total = $cartItems->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;
        
        $shippingAddress = Billing::where('user_id', auth()->id())->limit(1)->get(); //LIMIT

        return view('shipping', compact('cartItems', 'shippingCost', 'total', 'grand_total', 'shippingAddress'));
    }

}
