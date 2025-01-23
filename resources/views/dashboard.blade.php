@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Orders Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-700">Total Orders</h2>
                <p class="text-3xl font-extrabold text-cyan-500 mt-2">1,234</p>
            </div>
            <i class="ri-file-list-3-line text-5xl text-yellow-500"></i>
        </div>
    </div>

    <!-- Restaurants Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-700">Restaurants</h2>
                <p class="text-3xl font-extrabold text-cyan-500 mt-2">25</p>
            </div>
            <i class="ri-restaurant-line text-5xl text-yellow-500"></i>
        </div>
    </div>

    <!-- Customers Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-700">Customers</h2>
                <p class="text-3xl font-extrabold text-cyan-500 mt-2">876</p>
            </div>
            <i class="ri-user-3-line text-5xl text-yellow-500"></i>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-700">Total Revenue</h2>
                <p class="text-3xl font-extrabold text-cyan-500 mt-2">$45,678</p>
            </div>
            <i class="ri-money-dollar-circle-line text-5xl text-yellow-500"></i>
        </div>
    </div>

    <!-- Feedback Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-700">Feedbacks</h2>
                <p class="text-3xl font-extrabold text-cyan-500 mt-2">150</p>
            </div>
            <i class="ri-feedback-line text-5xl text-yellow-500"></i>
        </div>
    </div>

    <!-- Active Users Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-700">Active Users</h2>
                <p class="text-3xl font-extrabold text-cyan-500 mt-2">312</p>
            </div>
            <i class="ri-user-heart-line text-5xl text-yellow-500"></i>
        </div>
    </div>
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
