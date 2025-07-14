<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function index(){
        $allSize = Size::latest()->get();
        return view('admin.size.index', compact('allSize'));
    }

    public function create(){
        return view('admin.size.create');
    }


 public function store(Request $request)
    {
        $request->validate([
            'size_name' => 'required|unique:sizes',
        ]);

        Size::create([
            'size_name' => $request->size_name,
            'slug' => strtolower(str_replace( '', '-', $request->size_name))
        ]);

        return back()->with('success', 'Success! data insert Successfully');
    }


    public function edit($id){
        $editSize = Size::FindOrFail($id);

        return view('admin.size.edit', compact('editSize'));

    }

    public function update(Request $request){
        $id = $request->id;

        $request->validate([
            'size_name' => 'required|unique:sizes',
        ]);

        Category::FindOrFail($id)->update([
            'size_name' => $request->size_name,
            'slug' => strtolower(str_replace( '', '-', $request->size_name))
        ]);


        return redirect()->route('admin.size.index')->with('success', 'Success! data update Successfully');

    }

    public function delete($id){
        Size::FindOrFail($id)->delete();
        return back()->with('success', 'Success! data delete Successfully');
    }
}
