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
            'subCategory_name' => 'required|unique:sub_categories',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);


        $category_id = $request->category_id;
        $category_name = Category::where('id', $category_id)->value('category_name');
        
        $brand_id = $request->brand_id;
        $brand_name = Brand::where('id', $brand_id)->value('brand_name');

        SubCategory::insert([
            'subCategory_name' => $request->subCategory_name,
            'slug' => strtolower(str_replace( '', '-', $request->subCategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,
            'brand_id' => $brand_id,
            'brand_name' => $brand_name
        ]);

        return back()->with('success', 'Success! data insert Successfully');
    }


    public function edit($id){
        $editSubCategory = SubCategory::FindOrFail($id);

        return view('admin.subCategory.edit', compact('editSubCategory'));

    }

    public function update(Request $request){
        $id = $request->id;

        $request->validate([
            'subCategory_name' => 'required|unique:sub_categories',
        ]);

        Category::FindOrFail($id)->update([
            'subCategory_name' => $request->subCategory_name,
            'slug' => strtolower(str_replace( '', '-', $request->subCategory_name))
        ]);


        return redirect()->route('admin.subCategory.index')->with('success', 'Success! data update Successfully');

    }

    public function delete($id){
        SubCategory::FindOrFail($id)->delete();
        return back()->with('success', 'Success! data delete Successfully');
    }





}
