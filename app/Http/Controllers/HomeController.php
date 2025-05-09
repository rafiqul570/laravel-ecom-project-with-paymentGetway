<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    // Role Controll
    public function roleControll(){
        $role = Auth::user()->role;
        if($role == '1'){
            return view('admin.dashboard');
        }else{
            return view('home');
        }


    }



      //data show home page
      public function home(){
        $allCategory = Category::latest()->get();
        $allProduct = Product::latest()->get();
        return view('home', compact('allCategory', 'allProduct'));
        }

    
}
