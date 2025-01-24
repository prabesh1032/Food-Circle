<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Store a new order.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'menu_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'payment_method' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        dd($data);
        // Add additional fields
        $data['user_id'] = auth()->user()->id;
        $data['status'] = 'pending';

        // Create the order
        Order::create($data);

        // Remove the cart item
        CartItem::find($request->cart_id)->delete();
        return redirect('/')->with('success', 'Order has been placed successfully!');
    }

    /**
     * List all orders.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        dd($orders);
        return view('order.index', compact('orders'));
    }

    /**
     * Update order status.
     */
    public function status($id, $status)
    {
        $order = Order::find($id);
        $order->status = $status;
        $order->save();

        // Prepare email data
        $emaildata = [
            'name' => $order->user->name,
            'status' => $status,
        ];

        // Send order status notification email
        Mail::send('emails.orderemail', $emaildata, function ($message) use ($order) {
            $message->to($order->user->email, $order->user->name)
                    ->subject('Order Notification');
        });

        return back()->with('success', 'Order status updated to ' . $status);
    }
}
