<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
    public function menu()
    {
        return view('menu');
    }
    public function viewmenu($id)
    {
        $menu = Menu::find($id);
        $relatedmenus = Menu::where('category_id', $menu->category_id)->where('id', '!=', $id)
            ->limit(4)->get();
        return view('viewmenu', compact('menu', 'relatedmenus'));
    }
}
