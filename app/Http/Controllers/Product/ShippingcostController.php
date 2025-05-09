<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\Shippingcost;

class ShippingcostController extends Controller
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

        Shippingcost::insert([
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

}
