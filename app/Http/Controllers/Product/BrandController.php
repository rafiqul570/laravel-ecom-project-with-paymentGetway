<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
        $allBrand = Brand::latest()->get();
        return view('admin.brand.index', compact('allBrand'));
    }

    public function create(){
        return view('admin.brand.create');
    }


 public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands',
        ]);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'slug' => strtolower(str_replace( '', '-', $request->brand_name))
        ]);

        return back()->with('success', 'Success! data insert Successfully');
    }


    public function edit($id){
        $editBrand = Brand::FindOrFail($id);

        return view('admin.brand.edit', compact('editBrand'));

    }

    public function update(Request $request){
        $id = $request->id;

        $request->validate([
            'brand_name' => 'required|unique:brands',
        ]);

        Category::FindOrFail($id)->update([
            'brand_name' => $request->brand_name,
            'slug' => strtolower(str_replace( '', '-', $request->brand_name))
        ]);


        return redirect()->route('admin.brand.index')->with('success', 'Success! data update Successfully');

    }

    public function delete($id){
        Brand::FindOrFail($id)->delete();
        return back()->with('success', 'Success! data delete Successfully');
    }
}
