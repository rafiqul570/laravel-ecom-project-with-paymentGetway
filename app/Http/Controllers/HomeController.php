<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;


class HomeController extends Controller
{

    // Role Controll
    public function roleControll(){
        
        $role = Auth::user()->role;
        
        if($role == '1'){
            
            $total_product = Product::all()->count();
            
            $total_order = Order::all()->count();
            
            $total_customer = User::all()->count();

            $order = Order::all(); 
            $total_revenue = 0;
            
            foreach ($order as $order) {
              $total_revenue = $total_revenue + $order->product_price; 
            }

            $total_deliverd = Order::where('delivery_status', '=', 'delivered')->get()->count();
            
            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();


            
            return view('admin.dashboard', compact('total_product', 'total_order', 'total_customer', 'total_revenue', 'total_deliverd', 'total_processing'));
        
        }else{
           
            return view('home');
        
        }


    }



  //data show home page
  public function home(){
    $categories = Category::all();
    $subCategories = SubCategory::all();
    $allProduct = Product::latest()->get();
    $categories = Category::with('subCategories.products')->get();
    return view('home', compact('allProduct','categories', 'categories', 'subCategories'));
    }




    
}
