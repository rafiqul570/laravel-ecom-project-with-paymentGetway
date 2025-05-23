<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\Shippingcost;
use File;
use DB;

class ProductController extends Controller
{
   
    public function index(){
        $allProduct = Product::latest()->get();
        return view('admin.product.index', compact('allProduct'));
    }

    public function create(){
        $allCategory = Category::latest()->get();
        $allSubCategory = SubCategory::latest()->get();
        $allBrand = Brand::latest()->get();
        $allColor = Color::latest()->get();
        $allSize = Size::latest()->get();
        $shippingCost = Shippingcost::latest()->get();
        return view('admin.product.create',compact('allCategory', 'allColor', 'allSize', 'shippingCost','allSubCategory','allBrand'));
    }


 public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'discount_price' => 'nullable|string',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'nullable|integer',
            'brand_name' => 'nullable|string',
            'color_id' => 'nullable|integer',
            'color_name' => 'nullable|string',
            'size_id' => 'nullable|integer',
            'size_name' => 'nullable|string',
            'product_quantity' => ['required', 'integer', 'min:1'],
            'short_description' => 'required',
            'long_description' => 'required',
            'shippingCost' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg}max:2048',
        ]);
        
    //image Insert 
            $image_name = '';
        if($request->has('product_img')){
            $image = $request->file('product_img');
            $image_name = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/image/',$image_name);
            
        }
            
            $category_id = $request->category_id;
            $category_name = Category::where('id', $category_id)->value('category_name');

            $sub_category_id = $request->sub_category_id;
            $subCategory_name = SubCategory::where('id', $sub_category_id)->value('subCategory_name');

            $brand_id = $request->brand_id;
            $brand_name = Brand::where('id', $brand_id)->value('brand_name');

            $color_id = $request->color_id;
            $color_name = Color::where('id', $color_id)->value('color_name');

            $size_id = $request->size_id;
            $size_name = Size::where('id', $size_id)->value('size_name');
           

        Product::insert([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'discount_price' => $request->discount_price,
            'product_quantity' => $request->product_quantity,
            'category_id' => $request->category_id,
            'category_name' => $category_name,
            'sub_category_id' => $request->sub_category_id,
            'subCategory_name' => $subCategory_name,
            'brand_id' => $request->brand_id,
            'brand_name' => $brand_name,
            'color_id' => $request->color_id,
            'color_name' => $color_name,
            'size_id' => $request->size_id,
            'size_name' => $size_name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'shippingCost' => $request->shippingCost,
            'product_img' => $image_name,
            'slug' => strtolower(str_replace( ' ', '-', $request->product_name)),
        ]);

             SubCategory::where('id', $sub_category_id)->increment('product_count',1);


        return back()->with('success', 'Success! data insert Successfully');
    }


    public function edit($id){
        $product = Product::FindOrFail($id);
        return view('admin.product.edit', compact('product'));

    }

    public function editImage($id){
        $product = Product::FindOrFail($id);
        return view('admin.product.editImage', compact('product'));

    }

    
    public function updateImage(Request $request){
        
        $id = $request->id;
        $product = Product::FindOrFail($id);

    $request->validate([
        'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg}max:2048',
       
    ]);

    //image upload 
    $image_name = '';
    $deleteOldImage='uploads/image/'.$product->product_img;
    
    if($request->has('product_img')){
        $image = $request->file('product_img');
        if(file_exists($deleteOldImage)){
            File::delete($deleteOldImage);
        }
        
        $image_name = uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('uploads/image/',$image_name);   
    
    }

    Product::FindOrFail($id)->update([
        'product_img' => $image_name,
        
    ]);


    return redirect()->route('admin.product.index')->with('success', 'Success! data update Successfully');

}


    public function update(Request $request){
        
            $id = $request->id;
            $product = Product::FindOrFail($id);

        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'discount_price' => 'required',
            'product_color' => 'required',
            'product_size' => 'required',
            'product_quantity' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
           
            
        ]);

        //image upload 
        $image_name = '';
        $deleteOldImage='uploads/image/'.$product->product_img;
        
        if($request->has('product_img')){
            $image = $request->file('product_img');
            if(file_exists($deleteOldImage)){
                File::delete($deleteOldImage);
            }
            
            $image_name = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/image/',$image_name);   
        }else{
            $image_name = $product->product_img;
        }

        Product::FindOrFail($id)->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'discount_price' => $request->discount_price,
            'product_color' => $request->product_color,
            'product_size' => $request->product_size,
            'product_quantity' => $request->product_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'product_img' => $image_name,
            'slug' => strtolower(str_replace( ' ', '-', $request->product_name)),
        ]);


        return redirect()->route('admin.product.index')->with('success', 'Success! data update Successfully');

    }

    //Delete
    public function delete($id){
        $category_id = Product::where('id', $id)->value('category_id');
        $product = Product::FindOrFail($id);
        
        $image = 'uploads/image/'.$product->product_img;
        if(file_exists($image)){
        File::delete($image);
        }
        
        $product->delete();
        
        Category::where('id', $category_id)->decrement('product_count',1);
        return back()->with('success', 'Success! data delete Successfully');
    }


    //Related product
    public function RelatedProducts($id){

        $product = Product::FindOrFail($id);
        
        $related_product = Product::where('sub_category_id', $product->sub_category_id)->take(6)->get();
        
        return view('products', compact('product', 'related_product'));


    }



    //shop page filtering system

    public function shop()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        $products = Product::all();
        
        return view('product.shop', compact('categories', 'subCategories', 'products', 'brands', 'colors', 'sizes'));
    }

    
    // sidebar Filter in shop page

    public function filter(Request $request)
    {
        $query = Product::query();
  
        if ($request->search) {
           $query->where(function ($q) use ($request) {
           $q->where('product_name', 'like', '%' . $request->search . '%')
          ->orWhere('slug', 'like', '%' . $request->search . '%')
          ->orWhere('product_price', 'like', '%' . $request->search . '%');
           });
          
          }


        if ($request->category_name) {
            $query->whereIn('category_name', $request->category_name);
        }

        if ($request->subCategory_name) {
            $query->whereIn('subCategory_name', $request->subCategory_name);
        }

        if ($request->brand_name) {
            $query->whereIn('brand_name', $request->brand_name);
        }

        if ($request->color_name) {
            $query->whereIn('color_name', $request->color_name);
        }

        if ($request->size_name) {
            $query->whereIn('size_name', $request->size_name);
        }

        if ($request->product_price) {
            $query->where(function($q) use ($request) {
                foreach ($request->product_price as $range) {
                    [$min, $max] = explode('-', $range);
                    $q->orWhereBetween('product_price', [(int)$min, (int)$max]);
                }
            });
        }

        $products = $query->get();

        return response()->json($products);
    }

   

    
}




