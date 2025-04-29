<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function index()
{
    $customers = User::with(['orders.menu'])->get();
    return view('customer', compact('customers'));
}

}
