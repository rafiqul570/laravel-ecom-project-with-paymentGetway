<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;
use DB;




class ClaintController extends Controller
{

    //data show category_page
    
    public function categoryPage($id, $slug)
{
    $categories = Category::all();

    $subCategories = SubCategory::all();

    $category = Category::findOrFail($id);

    // Use paginate() instead of get()
    $products = Product::where('category_id', $id)->paginate(12); // 12 per page

    return view('front.pages.categoryPage', compact('categories', 'subCategories', 'category', 'products'));
}


        //data show SubCategoryPage
        public function subCategoryPage($id, $slug)
    {
        $categories = Category::all();

        $subCategories = SubCategory::all();

        $subCategory = SubCategory::findOrFail($id);

        // Use paginate() instead of get()
        $products = Product::where('sub_category_id', $id)->paginate(12);

        return view('front.pages.subCategoryPage', compact('categories', 'subCategories', 'subCategory', 'products'));
    }



        // //shop page filtering system

        // public function shop()
        // {
        //     $categories = Category::all();
        //     $subCategories = SubCategory::all();
        //     $brands = Brand::all();
        //     $colors = Color::all();
        //     $sizes = Size::all();
        //     $products = Product::all();
            
        //     return view('product.shop', compact('categories', 'subCategories', 'products', 'brands', 'colors', 'sizes'));
        // }

        

        // public function filter(Request $request)
        // {
        //     $query = Product::query();

        //     // if ($request->search) {
        //     //     $query->where('slug', 'like', '%' . $request->search . '%');
        //     // }

                
        //     if ($request->search) {
        //        $query->where(function ($q) use ($request) {
        //        $q->where('product_name', 'like', '%' . $request->search . '%')
        //       ->orWhere('slug', 'like', '%' . $request->search . '%')
        //       ->orWhere('product_price', 'like', '%' . $request->search . '%');
        //        });
              
        //       }


        //     if ($request->category_name) {
        //         $query->whereIn('category_name', $request->category_name);
        //     }

        //     if ($request->subCategory_name) {
        //         $query->whereIn('subCategory_name', $request->subCategory_name);
        //     }

        //     if ($request->brand_name) {
        //         $query->whereIn('brand_name', $request->brand_name);
        //     }

        //     if ($request->color_name) {
        //         $query->whereIn('color_name', $request->color_name);
        //     }

        //     if ($request->size_name) {
        //         $query->whereIn('size_name', $request->size_name);
        //     }

        //     if ($request->product_price) {
        //         $query->where(function($q) use ($request) {
        //             foreach ($request->product_price as $range) {
        //                 [$min, $max] = explode('-', $range);
        //                 $q->orWhereBetween('product_price', [(int)$min, (int)$max]);
        //             }
        //         });
        //     }

        //     $products = $query->get();

        //     return response()->json($products);
        // }

        

         public function UserProfile(){

            return view('front.userProfile.dashboard');
        }





}
