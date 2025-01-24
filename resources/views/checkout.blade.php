@extends('layouts.master')

@section('content')
<h1 class="text-yellow-500 text-4xl font-extrabold text-center mt-8">Checkout</h1>

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg border-2 border-yellow-500">

    <!-- Success and Error Messages -->
    @if (session('success'))
        <div class="text-green-500 text-center mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="text-red-500 text-center mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Order Form -->
    <form action="{{ route('orders.store') }}" method="post" id="COD">
        @csrf
        <!-- Food Details -->
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Food Image -->
            @if($cart->menu)
                <img src="{{ asset('menus/' . $cart->menu->image) }}" alt="Food Image" class="w-full md:w-1/3 h-44 object-cover rounded-lg shadow-md">
            @else
                <div class="w-full md:w-1/3 h-44 bg-gray-300 rounded-lg shadow-md"></div>
            @endif

            <!-- Food Info -->
            <div class="flex-1">
                <h2 class="text-3xl font-bold text-black">{{ $cart->menu ? $cart->menu->name : 'Item Unavailable' }}</h2>
                <p class="text-lg text-gray-700 mt-4">
                    <span class="font-semibold">Price:</span> ${{ number_format($cart->menu ? $cart->menu->price : 0, 2) }}
                </p>
                <p class="text-lg text-gray-700">
                    <span class="font-semibold">Quantity:</span> {{ $cart->quantity }}
                </p>
                <p class="text-xl text-gray-900 font-bold mt-4">
                    <i class="ri-calculator-line text-yellow-500"></i> Total: ${{ number_format(($cart->menu ? $cart->menu->price : 0) * $cart->quantity, 2) }}
                </p>
            </div>
        </div>

        <!-- Hidden Inputs for menu_id, price, quantity, and cart_id -->
        <input type="hidden" name="menu_id" value="{{ $cart->menu ? $cart->menu->id : '' }}">
        <input type="hidden" name="price" value="{{ $cart->menu ? $cart->menu->price : 0 }}">
        <input type="hidden" name="quantity" value="{{ $cart->quantity }}">
        <input type="hidden" name="cart_id" value="{{ $cart->id }}">

        <!-- Customer Information -->
        <h2 class="text-2xl font-bold text-black mb-4">Customer Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="text-gray-600 font-semibold">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400">
                @error('name')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email -->
            <div>
                <label for="email" class="text-gray-600 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400">
                @error('email')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Address -->
        <div class="mt-6">
            <label for="address" class="text-gray-600 font-semibold">Delivery Address</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Enter your delivery address"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-cyan-400">
            @error('address')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Payment Information -->
        <h2 class="text-2xl font-bold text-black mt-8 mb-4">Payment Method</h2>
        <div class="flex gap-6">
            <label class="flex items-center gap-2">
                <input type="radio" name="payment_method" value="cash" class="focus:ring-2 focus:ring-cyan-400" required>
                <span class="text-gray-700 font-medium">Cash on Delivery</span>
            </label>
            @error('payment_method')
                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Button -->
        <div class="mt-10 text-center">
            <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400 shadow-lg flex items-center gap-2 justify-center">
                <i class="ri-check-double-line"></i> Confirm Order
            </button>
        </div>
    </form>
</div>

<!-- Back to Cart Button -->
<div class="text-center mt-8">
    <a href="{{ route('cart.index') }}" class="text-cyan-600 font-medium hover:underline flex items-center justify-center gap-2">
        <i class="ri-arrow-left-line"></i> Back to Cart
    </a>
</div>

@endsection
