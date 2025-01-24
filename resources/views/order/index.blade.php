@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold text-center my-6">Orders</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Order ID</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Menu Item</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Customer Name</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Quantity</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Price</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Payment Method</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $order->id }}</td>
                        <td class="py-3 px-4">{{ $order->menu->name }}</td>
                        <td class="py-3 px-4">{{ $order->name }}</td>
                        <td class="py-3 px-4">{{ $order->quantity }}</td>
                        <td class="py-3 px-4">{{ $order->price }}</td>
                        <td class="py-3 px-4">{{ ucfirst($order->payment_method) }}</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'canceled') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('orders.status', [$order->id, 'completed']) }}"
                               class="text-sm bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition">
                               Mark as Completed
                            </a>
                            <a href="{{ route('orders.status', [$order->id, 'canceled']) }}"
                               class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                               Cancel
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-6 text-center text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links('pagination::tailwind') }}
    </div>
</div>
@endsection
