@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($cards as $card)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-700">{{ $card['label'] }}</h2>
                        <p class="text-3xl font-extrabold text-cyan-500 mt-2">{{ $card['value'] }}</p>
                    </div>
                    <i class="{{ $card['icon'] }} text-5xl {{ $card['iconColor'] }}"></i>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Orders Section -->
    <div class="mt-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Recent Orders</h2>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full bg-white border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Order ID</th>
                        <th class="py-3 px-6 text-left">Customer</th>
                        <th class="py-3 px-6 text-center">Items</th>
                        <th class="py-3 px-6 text-center">Total</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    <!-- Example Row -->
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">#1001</td>
                        <td class="py-3 px-6 text-left">John Doe</td>
                        <td class="py-3 px-6 text-center">3</td>
                        <td class="py-3 px-6 text-center">$45.00</td>
                        <td class="py-3 px-6 text-center">
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Delivered</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <a href="#" class="text-blue-500 hover:underline">View</a>
                        </td>
                    </tr>
                    <!-- Add more rows dynamically here -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
