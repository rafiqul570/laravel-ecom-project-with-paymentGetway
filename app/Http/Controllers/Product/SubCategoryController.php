<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;

class SubCategoryController extends Controller
{
    public function index(){
        
        $allSubCategory = SubCategory::latest()->get();
        
        return view('admin.subCategory.index', compact('allSubCategory'));
    }

    public function create(){
        
        $allCategory = Category::latest()->get();
        $allBrand = Brand::latest()->get();
        
        return view('admin.subCategory.create', compact('allCategory', 'allBrand'));
    }


    public function store(Request $request){

        $request->validate([
            'subCategory_name' => 'required|unique:sub_categories,subCategory_name',
            'category_id' => 'required',
            'brand_id' => 'nullable|integer|exists:brands,id',
        ]);


        $category = Category::findOrFail($request->category_id);
        
        $brand_id = null;
        $brand_name = null;

        // যদি ফর্ম থেকে brand_id আসে এবং খালি না থাকে, তবেই শুধু ব্র্যান্ডের তথ্য নেওয়া হবে
        if ($request->filled('brand_id')) {
            $brand_id = $request->brand_id;
            $brand = Brand::find($brand_id);
            $brand_name = $brand ? $brand->brand_name : null;
        }

        SubCategory::create([
            'subCategory_name' => $request->subCategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subCategory_name)),
            'category_id' => $category->id,
            'category_name' => $category->category_name,
            'brand_id' => $brand_id,
            'brand_name' => $brand_name
        ]);

        return back()->with('success', 'সাফল্য! সাবক্যাটাগরি সফলভাবে তৈরি হয়েছে।');
    }


    public function edit($id){
        $editSubCategory = SubCategory::FindOrFail($id);

        return view('admin.subCategory.edit', compact('editSubCategory'));

    }

    public function update(Request $request){
        $id = $request->id;

        $request->validate([
            'subCategory_name' => 'required|unique:sub_categories,subCategory_name,' . $id,
        ]);

        SubCategory::FindOrFail($id)->update([
            'subCategory_name' => $request->subCategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subCategory_name))
        ]);


        return redirect()->route('admin.subCategory.index')->with('success', 'সাফল্য! ডেটা সফলভাবে আপডেট হয়েছে।');

    }

    public function delete($id){
        SubCategory::FindOrFail($id)->delete();
        return back()->with('success', 'সাফল্য! ডেটা সফলভাবে ডিলিট হয়েছে।');
    }
}