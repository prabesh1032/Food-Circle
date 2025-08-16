<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('menuCategory')->get(); // Fetch menus with category details
        return view('menus.index', compact('menus'));
    }

    public function menus()
    {
        // Assuming you have a Category model and each menu belongs to a category
        $categories = MenuCategory::all();
        $menus = Menu::all();

        return view('menu', compact('categories', 'menus'));
    }


    public function create()
    {
        $categories = MenuCategory::orderBy('priority')->get(); // Get  categories for the dropdown
        return view('menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category_menus,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_available' => 'required|boolean',
        ]);
        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('menus'), $imagename);
            $data['image'] = $imagename;
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Menu item created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = MenuCategory::orderBy('priority')->get(); // Get categories for the dropdown
        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category_menus,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_available' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('menus'), $imagename);

            //delete the old photo if exist
            if ($menu->image) {
                $oldimage = public_path('menus') . '/' . $menu->image;
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }
            $menu->image = $imagename;
        }

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->image) {
            $oldimage = public_path('menus') . '/' . $menu->image;
            if (is_file($oldimage)) {
                unlink($oldimage);
            }
        }
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu item deleted successfully.');
    }
}
