<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index()
    {
        // $categories=Category::all();
        $categories=MenuCategory::orderBy('priority')->get();
        return view('menucategory.index',compact('categories'));
    }
    public function create()
    {
        return view('menucategory.create');
    }
    public function store(request$request)
    {
        $data= $request->validate([
            'name'=>'required|alpha',
            'priority'=>'required|integer',
        ]);
        MenuCategory::create($data);
       return redirect()->route('menucategory.index')->with('success','Category Created Sucessfully');
    }
    public function edit($id)
    {
        $category=MenuCategory::find($id);
        return view('menucategory.edit',compact('category'));
    }
    public function update(Request $request,$id)
    {
        $data=$request->validate([
            'name'=>'required | alpha',
            'priority'=>'required| integer'
        ]);
        $category=MenuCategory::find($id);
        $category->update($data);
        return redirect()->route('menucategory.index')->with('success','Category updated Sucessfully');
    }
    public function destroy($id)
    {
        MenuCategory::find  ($id)->delete();
        return redirect()->route('menucategory.index')->with('success','Category Deleted Sucessfully');
    }

}
