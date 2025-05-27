<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Store a new direct order.
     */
    public function directCheckout(Request $request)
    {
        $data = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($data['menu_id']);

        $data['total_price'] = $menu->price * $data['quantity'];

        return view('checkout', [
            'menu' => $menu,
            'quantity' => $data['quantity'],
            'total_price' => $data['total_price'],
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $data['user_id'] = auth()->id();
        $data['status'] = 'Pending';
        $data['total_price'] = $data['price'] * $data['quantity'];

        // Create order
        $order = Order::create($data);

        // Prepare data for email
        $menu = Menu::find($data['menu_id']);
        $emailData = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'menuName' => $menu->name,
            'quantity' => $data['quantity'],
            'totalPrice' => $data['total_price'],
            'paymentMethod' => $data['payment_method'],
            'status' => $data['status'],
        ];

        // Send order confirmation email to user
        Mail::send('email.orderemail', $emailData, function ($message) use ($data) {
            $message->to(auth()->user()->email)
                ->subject('Your FoodCircle Order Confirmation');
        });

        return redirect('/')->with('success', 'Your order has been placed successfully!');
    }


    /**
     * List all orders.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('order.index', compact('orders'));
    }

    /**
     * Update order status and notify customer via email.
     */
    public function status($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = ucfirst($status);
        $order->save();

        // Prepare email data
        $emailData = [
            'name' => $order->user->name,
            'status' => $order->status,
        ];

        // Send email notification


        return back()->with('success', 'Order status updated to ' . $order->status . ' and notification sent.');
    }
    public function userOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with('menu')
            ->latest()
            ->get();

        return view('order.userorder', compact('orders'));
    }

    public function cancelOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id != auth()->user()->id) {
            return redirect()->route('myorders')->with('error', 'You are not authorized to cancel this order.');
        }

        $orderTime = Carbon::parse($order->created_at);
        $now = Carbon::now();
        $diffInMinutes = $orderTime->diffInMinutes($now);

        if ($diffInMinutes <= 60 && $order->status != 'Cancelled') {
            // Optional: send a cancellation email

            $order->status = 'Cancelled';
            $order->save();

            return redirect()->route('myorders')->with('success', 'Your order has been cancelled.');
        } else {
            return redirect()->route('myorders')->with('error', 'You can only cancel the order within 1 hour of placing it.');
        }
    }
    public function destroy(Order $order)
    {
        if ($order->status != 'Cancelled') {
            return redirect()->back()->with('error', 'Only Cancelled orders can be deleted.');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Cancelled order has been deleted successfully.');
    }
}
