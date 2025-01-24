<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\MenuItem; // Assuming this is your product model
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Store cart item
    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_id' => 'required',
            'quantity' => 'required|integer'
        ]);

        $data['user_id'] = auth()->user()->id;

        // Check if the item already exists in the cart
        $check = CartItem::where('user_id', $data['user_id'])->where('menu_id', $data['menu_id'])->count();

        if ($check > 0) {
            return back()->with('error', 'Items already in cart');
        }

        // Create new cart entry
        CartItem::create($data);

        return back()->with('success', 'Items added to cart successfully');
    }

    // View the cart
    public function myCart()
    {
        $carts = CartItem::with('menu')->where('user_id', auth()->user()->id)->get();
        return view('cart', compact('carts'));
    }

    // Remove cart item
    public function destroy(Request $request)
    {
        // Delete cart item based on the provided data ID
        CartItem::find($request->dataid)->delete();
        return back()->with('success', 'Product removed from cart successfully');
    }

    // Checkout
    public function checkout($id)
    {
        $cart = CartItem::find($id);

        // Ensure the user is authorized
        if ($cart->user_id != auth()->user()->id) {
            return back()->with('error', 'Unauthorized access');
        }

        // Proceed with the checkout process
        return view('checkout', compact('cart'));
    }
}
