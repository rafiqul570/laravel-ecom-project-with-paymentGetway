<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
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
        $allColor = Color::latest()->get();
        $allSize = Size::latest()->get();
        $shippingCost = Shippingcost::latest()->get();
        return view('admin.product.create',compact('allCategory', 'allColor', 'allSize', 'shippingCost'));
    }


 public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'category_id' => 'required',
            'color_id' => 'required',
            'product_quantity' => 'required',
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
            $color_id = $request->color_id;
            
            $category_name = Category::where('id', $category_id)->value('category_name');
            $color_name = Color::where('id', $color_id)->value('color_name');
           

        Product::insert([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'category_id' => $request->category_id,
            'category_name' => $category_name,
            'color_id' => $request->color_id,
            'color_name' => $color_name,
            'product_quantity' => $request->product_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'shippingCost' => $request->shippingCost,
            'product_img' => $image_name,
            'slug' => strtolower(str_replace( ' ', '-', $request->product_name)),
        ]);

             Category::where('id', $category_id)->increment('product_count',1);


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

    
}

