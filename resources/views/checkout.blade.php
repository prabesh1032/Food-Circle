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
    <form action="{{ route('orders.store') }}" method="post" id="checkoutForm">
        @csrf

        <!-- Food Details -->
        <div class="flex flex-col md:flex-row gap-8">
            <img src="{{ asset('menus/' . $menu->image) }}" alt="Food Image" class="w-full md:w-1/3 h-44 object-cover rounded-lg shadow-md">

            <div class="flex-1">
                <h2 class="text-3xl font-bold text-black">{{ $menu->name }}</h2>
                <p class="text-lg text-gray-700 mt-4">
                    <span class="font-semibold">Price:</span> ${{ number_format($menu->price, 2) }}
                </p>
                <p class="text-lg text-gray-700">
                    <span class="font-semibold">Quantity:</span> {{ $quantity }}
                </p>
                <p class="text-xl text-gray-900 font-bold mt-4">
                    <i class="ri-calculator-line text-yellow-500"></i>
                    Total: ${{ number_format($menu->price * $quantity, 2) }}
                </p>
            </div>
        </div>

        <!-- Hidden Inputs -->
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        <input type="hidden" name="price" value="{{ $menu->price }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">

        <!-- Customer Information -->
        <h2 class="text-2xl font-bold text-black mb-4 mt-8">Customer Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="text-gray-600 font-semibold">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <div>
                <label for="email" class="text-gray-600 font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-yellow-400" required>
            </div>
            <div class="mt-6">
                <label for="phone" class="text-gray-600 font-semibold">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-cyan-400" required>
            </div>
        </div>
        <div class="mt-6">
            <label for="address" class="text-gray-600 font-semibold">Delivery Address</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Enter your delivery address"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-cyan-400" required>
        </div>

        <!-- Payment Information -->
        <h2 class="text-2xl font-bold text-black mt-8 mb-4">Payment Method</h2>
        <div class="flex gap-6">
            <label class="flex items-center gap-2">
                <input type="radio" id="paymentMethod" name="payment_method" value="COD" class="focus:ring-2 focus:ring-cyan-400" required>
                <span class="text-gray-700 font-medium">Cash on Delivery</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" id="paymentMethod" name="payment_method" value="esewa" class="focus:ring-2 focus:ring-cyan-400" required>
                <span class="text-gray-700 font-medium">eSewa</span>
            </label>
        </div>

        <!-- Confirm Button -->
        <div class="mt-10 text-center">
            <button type="button" id="paymentButton" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400 shadow-lg flex items-center gap-2 justify-center">
                <i class="ri-check-double-line"></i> Confirm Order
            </button>
        </div>
    </form>

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
</div>

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
