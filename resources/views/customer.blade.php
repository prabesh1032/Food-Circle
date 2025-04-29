@extends('layouts.app')
@section('title', 'Customers')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-cyan-50 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-500 to-amber-500">
                    Our Valued Customers
                </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                The distinguished guests who honor us with their patronage
            </p>
        </div>

        <!-- Customer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach($customers as $customer)
            <div class="relative group">
                <!-- Gold accent border on hover -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-amber-400 to-amber-600 rounded-xl blur opacity-0 group-hover:opacity-50 transition duration-300"></div>

                <!-- Customer card -->
                <div class="relative h-full bg-white rounded-xl shadow-lg overflow-hidden border border-cyan-100 transition-all duration-300 transform group-hover:-translate-y-1">
                    <!-- Customer header with cyan gradient -->
                    <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 p-6 flex items-center">
                        <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-amber-300 border-2 border-amber-300 text-2xl font-bold mr-4">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $customer->name }}</h3>
                            <p class="text-cyan-100">VIP Member #{{ $loop->iteration }}</p>
                        </div>
                    </div>

                    <!-- Customer details -->
                    <div class="p-6 space-y-4">
                        <!-- Contact info -->
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 text-cyan-500">
                                    <i class="ri-mail-line"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-cyan-600 uppercase tracking-wider">Email</p>
                                    <p class="text-gray-900 font-medium text-sm truncate">{{ $customer->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 text-amber-500">
                                    <i class="ri-phone-line"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-cyan-600 uppercase tracking-wider">Phone</p>
                                    <p class="text-gray-900 font-medium text-sm">{{ $customer->phone ?? 'Not provided' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 text-cyan-400">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs font-medium text-cyan-600 uppercase tracking-wider">Location</p>
                                    <p class="text-gray-900 font-medium text-sm">{{ $customer->address ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats divider -->
                        <div class="border-t border-cyan-100 pt-4 mt-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <p class="text-xs font-medium text-cyan-600 uppercase tracking-wider">Orders</p>
                                    <p class="text-2xl font-bold text-cyan-500">{{ $customer->orders->count() }}</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-medium text-cyan-600 uppercase tracking-wider">Reviews</p>
                                    <p class="text-2xl font-bold text-amber-500">0</p>
                                </div>
                            </div>
                        </div>

                        <!-- Favorite dish -->
                        @if($customer->orders->isNotEmpty())
                        <div class="mt-4 pt-4 border-t border-cyan-100">
                            <p class="text-xs font-medium text-cyan-600 uppercase tracking-wider mb-1">Favorite Dish</p>
                            <div class="flex items-center bg-cyan-50 rounded-lg p-3 border border-cyan-100">
                                <div class="flex-shrink-0 h-10 w-10 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-500 border border-cyan-200">
                                    <i class="ri-restaurant-line"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 font-medium text-sm">{{ $customer->orders->first()->menu->name ?? 'N/A' }}</p>
                                    <p class="text-xs text-amber-500">Most ordered</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
