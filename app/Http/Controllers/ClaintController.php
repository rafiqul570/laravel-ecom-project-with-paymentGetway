<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;
use DB;




class ClaintController extends Controller
{

    //data show category_page
    
    public function CategoryPage($id){
        $allCategory = Category::findOrFail($id);
        $allProduct = Product::where('category_id', $id)->latest()->get();
        return view('front.pages.categoryPage', compact('allCategory', 'allProduct'));
    }


    public function products($id){

        $product = Product::FindOrFail($id);
        $related_product = Product::where('category_id', $product->category_id)->take(6)->get();
        return view('products', compact('product', 'related_product'));

    }


    public function payment(){
        
        $paymentMethod = Cart::where('user_id', auth()->id())->get();

        //$cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        $shippingCost = Cart::where('user_id', auth()->id())->value('shippingCost');
        
        $total = $paymentMethod->sum(fn($item) => $item->product_price * $item->product_quantity);

        $grand_total = $total + $shippingCost;

        return view('front.pages.payment', compact( 'paymentMethod', 'grand_total'));
    }



     

   
    public function history(){

        return view('front.pages.history');
    }


    public function TodaysDeal(){

        return view('front.pages.todaysDeal');
    }

    public function CustomService(){

        return view('front.pages.customService');
    }


     public function UserProfile(){

        return view('front.userProfile.dashboard');
    }





}
