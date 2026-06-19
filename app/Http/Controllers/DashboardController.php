<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $cards = [
            [
                'label' => 'Total Orders',
                'value' => number_format(Order::count()),
                'icon' => 'ri-file-list-3-line',
                'iconColor' => 'text-yellow-500',
            ],
            [
                'label' => 'Menu Categories',
                'value' => number_format(MenuCategory::count()),
                'icon' => 'ri-restaurant-line',
                'iconColor' => 'text-yellow-500',
            ],
            [
                'label' => 'Customers',
                'value' => number_format(User::where('role', 'user')->count()),
                'icon' => 'ri-user-3-line',
                'iconColor' => 'text-yellow-500',
            ],
            [
                'label' => 'Total Revenue',
                'value' => '$' . number_format(Order::sum('total_price'), 2),
                'icon' => 'ri-money-dollar-circle-line',
                'iconColor' => 'text-yellow-500',
            ],
            [
                'label' => 'Menus',
                'value' => number_format(Menu::count()),
                'icon' => 'ri-feedback-line',
                'iconColor' => 'text-yellow-500',
            ],
            [
                'label' => 'Available Menus',
                'value' => number_format(Menu::where('is_available', true)->count()),
                'icon' => 'ri-user-heart-line',
                'iconColor' => 'text-yellow-500',
            ],
        ];

        return view('dashboard', compact('cards'));
    }
    public function index()
    {
        $customers = User::with(['orders.menu'])->get();
        return view('customer', compact('customers'));
    }
}
