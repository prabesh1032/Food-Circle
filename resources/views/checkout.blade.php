@extends('layouts.master')

@section('content')
<div class="bg-gradient-to-br from-yellow-50 via-yellow-100 to-yellow-50 min-h-screen py-16 px-4">
    <h1 class="text-cyan-600 text-5xl font-extrabold text-center mb-12 tracking-wide drop-shadow-md">
        Checkout
    </h1>

    <div class="max-w-4xl mx-auto bg-white p-12 rounded-3xl shadow-2xl border-t-8 border-yellow-400">
        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-center mb-6 font-semibold rounded-lg py-3 px-5 shadow-inner">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 text-red-700 text-center mb-6 font-semibold rounded-lg py-3 px-5 shadow-inner">
                {{ session('error') }}
            </div>
        @endif

        <!-- Order Summary -->
        <div class="flex flex-col md:flex-row items-center gap-10 border-b border-yellow-200 pb-8">
            <img src="{{ asset('menus/' . $menu->image) }}" alt="Food Image"
                class="w-full md:w-1/3 h-56 object-cover rounded-xl shadow-xl transition-transform hover:scale-105">
            <div class="flex-1 space-y-3">
                <h2 class="text-3xl font-semibold text-gray-900">{{ $menu->name }}</h2>
                <p class="text-lg text-gray-700"><span class="font-semibold">Price:</span> <span class="text-green-600">${{ number_format($menu->price, 2) }}</span></p>
                <p class="text-lg text-gray-700"><span class="font-semibold">Quantity:</span> {{ $quantity }}</p>
                <p class="mt-4 text-2xl font-extrabold text-yellow-600 flex items-center gap-2">
                    <i class="ri-calculator-line text-green-500 text-3xl"></i> Total: <span class="text-green-600">${{ number_format($menu->price * $quantity, 2) }}
                </p>
            </div>
        </div>

        <!-- Hidden Inputs -->
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        <input type="hidden" name="price" value="{{ $menu->price }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">

        <!-- Checkout Form -->
        <form action="{{ route('orders.store') }}" method="post" class="mt-10 space-y-10">
            @csrf

            <!-- Customer Information -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-yellow-400 pb-2">Customer Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="w-full px-5 py-3 border border-yellow-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-yellow-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            class="w-full px-5 py-3 border border-yellow-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-yellow-300 shadow-sm" required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="Enter your phone number"
                            class="w-full px-5 py-3 border border-yellow-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-yellow-300 shadow-sm" required>
                    </div>
                </div>
                <div class="mt-6">
                    <label for="address" class="block text-gray-700 font-semibold mb-2">Delivery Address</label>
                    <textarea id="address" name="address" placeholder="Enter your delivery address"
                        rows="4" required
                        class="w-full px-5 py-3 border border-yellow-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-yellow-300 shadow-sm resize-none">{{ old('address') }}</textarea>
                </div>
            </section>

            <!-- Payment Method -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b-2 border-yellow-400 pb-2">Payment Method</h2>
                <div class="flex flex-col md:flex-row gap-10">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="radio" id="payment_cod" name="payment_method" value="COD"
                            class="w-6 h-6 text-yellow-500 border-yellow-400 focus:ring-yellow-400" required>
                        <span class="text-gray-800 font-semibold group-hover:text-yellow-600 transition">Cash on Delivery</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="radio" id="payment_esewa" name="payment_method" value="esewa"
                            class="w-6 h-6 text-yellow-500 border-yellow-400 focus:ring-yellow-400" required>
                        <span class="text-gray-800 font-semibold group-hover:text-yellow-600 transition">eSewa</span>
                    </label>
                </div>
            </section>

            <!-- Confirm Order Button -->
            <div class="mt-12 text-center">
                <button type="submit"
                    class="inline-flex items-center gap-3 bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-xl px-10 py-4 rounded-full shadow-xl transition-transform transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-yellow-400">
                    <i class="ri-check-double-line text-2xl"></i> Confirm Order
                </button>
            </div>
        </form>
    </div>
</div>


<!-- eSewa Payment Form -->
@php
$total_amount = $total_price; // Ensure this value is defined earlier
$transaction_uuid = time(); // Unique transaction ID
$product_code = "EPAYTEST";
$msg = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";
$secret = "8gBm/:&EnhH.1/q"; // Replace with your actual secret key
$s = hash_hmac('sha256', $msg, $secret, true);
$signature = base64_encode($s);
@endphp

<form id="esewa" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" class="hidden">
    <input type="hidden" id="amount" name="amount" value="{{ $total_price }}" required>
    <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
    <input type="hidden" id="total_amount" name="total_amount" value="{{ $total_price }}" required>
    <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="{{ time() }}" required>
    <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
    <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
    <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>

    <!-- Update success_url with the correct GET route -->
    <input type="hidden" name="success_url" value="{{ route('order.storeEsewaGet', [$menu->id, $quantity]) }}" required>

    <input type="hidden" id="failure_url" name="failure_url" value="{{ route('esewa.failure') }}" required>
    <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
    <input type="hidden" id="signature" name="signature" value="{{ $signature }}" required>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentButton = document.getElementById('paymentButton');
        paymentButton.addEventListener('click', function (event) {
            event.preventDefault();

            const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            if (selectedPaymentMethod === 'COD') {
                document.getElementById('checkoutForm').submit();
            } else if (selectedPaymentMethod === 'esewa') {
                document.getElementById('esewa').submit();
            } else {
                alert('Please select a payment method.');
            }
        });
    });
</script>
@endsection
