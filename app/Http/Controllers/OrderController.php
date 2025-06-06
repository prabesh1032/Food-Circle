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

    public function storeEsewa(Request $request, $menu_id, $quantity)
    {
        $encodedData = $request->input('data');
        $decodedData = base64_decode($encodedData);
        $data = json_decode($decodedData);
        $transaction_uuid = time();
        $menu = Menu::findOrFail($menu_id);


        // ❌ Check if eSewa status is not COMPLETE
        if (!isset($data->status) || $data->status !== "COMPLETE") {
            return redirect('/')->with('error', '❌ eSewa payment failed.');
        }

        // ✅ Extract values safely
        $total_price = $data->total_amount ?? 0;
        $quantity = $quantity ?? 1;

        $user = auth()->user();

        // ✅ Create order
        $order = new Order();
        $order->menu_id = $menu_id;
        $order->total_price = $data->total_amount ?? 0; // Or calculate if necessary
        $order->quantity = $quantity ?? 1;
        $order->price = $menu->price ?? $order->total_price; // Set a default price value
        $order->payment_method = "eSewa";
        $order->name = $user->name;
        $order->phone = $user->phone ?? 'Not Provided';
        $order->address = $user->address ?? 'Not Provided';
        $order->user_id = $user->id;
        $order->status = "Pending";
        $order->save();

        // ✉️ Send email
$emaildata = [
    'order_id' => $order->id,
    'name' => $user->name,
    'email' => $user->email,
    'phone' => $user->phone,
    'address' => $user->address,
    'menu_name' => $menu->name,
    'menu_price' => $menu->price,
    'quantity' => $order->quantity,
    'total_price' => $order->total_price,
    'payment_method' => $order->payment_method,
    'status' => $order->status,
    'order_date' => $order->created_at->format('Y-m-d H:i:s'),
];

// Send the email
Mail::send('email.orderemail', $emaildata, function ($message) use ($order, $user) {
    $message->to($user->email, $user->name)
        ->subject('Order Confirmation - Order #' . $order->id);
});

        // ✅ Redirect with success
        return redirect('/')->with('success', '✅ Order completed via eSewa successfully.');
    }
    public function storeEsewaGet(Request $request, $menu_id, $quantity)
    {
        // Verify and process the success callback (similar to storeEsewa logic)
        return $this->storeEsewa($request, $menu_id, $quantity); // Reuse POST logic if safe
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
