<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
     public function index(){
        $allColor = Color::latest()->get();
        return view('admin.color.index', compact('allColor'));
    }

    public function create(){
        return view('admin.color.create');
    }


 public function store(Request $request)
    {
        $request->validate([
            'color_name' => 'required|unique:colors',
        ]);

        Color::insert([
            'color_name' => $request->color_name,
            'slug' => strtolower(str_replace( '', '-', $request->color_name))
        ]);

        return back()->with('success', 'Success! data insert Successfully');
    }


    public function edit($id){
        $editColor = Color::FindOrFail($id);

        return view('admin.color.edit', compact('editColor'));

    }

    public function update(Request $request){
        $id = $request->id;

        $request->validate([
            'color_name' => 'required|unique:colors',
        ]);

        Color::FindOrFail($id)->update([
            'color_name' => $request->color_name,
            'slug' => strtolower(str_replace( '', '-', $request->color_name))
        ]);


        return redirect()->route('admin.color.index')->with('success', 'Success! data update Successfully');

    }

    public function delete($id){
        Color::FindOrFail($id)->delete();
        return back()->with('success', 'Success! data delete Successfully');
    }
}
