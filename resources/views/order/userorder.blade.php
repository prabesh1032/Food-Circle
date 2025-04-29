@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-yellow-50 to-white">
    <div class="container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <div class="inline-block bg-yellow-100 rounded-full p-4 mb-6 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Your Order Journey</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Every bite tells a story. Relive your delicious moments and track current orders.
            </p>
        </div>

        <!-- Orders Grid -->
        @if($orders->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            @foreach($orders as $order)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <!-- Order Header -->
                <div class="bg-gray-900 text-white p-6 flex justify-between items-start">
                    <div>
                        <div class="flex items-center mb-2">
                            <span class="inline-block w-3 h-3 rounded-full mr-2
                                @if($order->status == 'Delivered') bg-green-400
                                @elseif($order->status == 'Cancelled') bg-red-400
                                @else bg-yellow-400 @endif"></span>
                            <span class="font-medium">{{ ucfirst($order->status) }}</span>
                        </div>
                        <h3 class="text-2xl font-bold">{{ $order->menu->name }}</h3>
                        <p class="text-gray-300">Order #{{ $order->id }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-300 text-sm">Order Date</p>
                        <p class="font-medium">{{ $order->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <!-- Order Content -->
                <div class="p-6">
                    <div class="flex mb-6">
                        <div class="w-1/3 pr-4">
                            <img src="{{ asset('menus/' . $order->menu->image) }}" alt="{{ $order->menu->name }}" class="w-full h-32 object-cover rounded-lg">
                        </div>
                        <div class="w-2/3">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-md font-bold text-gray-800">Quantity</p>
                                    <p class="font-bold text-blue-800">{{ $order->quantity }}</p>
                                </div>
                                <div>
                                    <p class="text-md font-bold text-gray-800">Payment</p>
                                    <p class="font-bold text-yellow-900">{{ $order->payment_method }}</p>
                                </div>
                                <div>
                                    <p class="text-md font-bold text-gray-800">Total Price</p>
                                    <p class="font-bold text-green-600">${{ number_format($order->total_price, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-md font-bold text-gray-800">Delivery To</p>
                                    <p class="font-extrabold text-indigo-500">{{ $order->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="text-md font-bold text-gray-800 mb-3 ">Order Timeline</h4>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-5 h-5 rounded-full bg-yellow-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-md font-bold text-gray-800">Order Placed</p>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>

                            @if($order->status == 'Completed')
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-5 h-5 rounded-full bg-green-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-md font-bold text-gray-800">Delivered</p>
                                    <p class="text-xs text-gray-500">{{ $order->updated_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>
                            @elseif($order->status == 'Cancelled')
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-5 h-5 rounded-full bg-red-400"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-md font-bold text-gray-800">Cancelled</p>
                                    <p class="text-xs text-gray-500">{{ $order->updated_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>
                            @else
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-5 h-5 rounded-full bg-gray-300"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-md font-bold text-gray-800">On the way</p>
                                    <p class="text-xs text-gray-500">Estimated delivery: Soon!</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Footer -->
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <div>
                        <p class="text-md font-bold text-gray-800">Need help with this order?</p>
                        <a href="#" class="text-sm font-bold text-yellow-600 hover:text-yellow-700">Contact Support</a>
                    </div>
                    @if(\Carbon\Carbon::parse($order->created_at)->diffInMinutes(\Carbon\Carbon::now()) <= 60 && $order->status != 'Cancelled')
                    <button data-action="{{ route('orders.cancel', $order->id) }}"
                            class="cancel-order-btn px-4 py-2 bg-red-500 border border-red-300 text-gray-800 rounded-lg hover:bg-red-50 transition duration-200">
                        Cancel Order
                    </button>
                    @elseif($order->status != 'Cancelled')
                    <button class="px-4 py-2 bg-red-100 text-gray-500 rounded-lg cursor-not-allowed">
                        Cancel Order
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-300 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">No Orders Yet</h2>
                <p class="text-gray-600 mb-6">Your culinary adventure awaits! Place your first order and we'll make it memorable.</p>
                <a href="{{ route('menus.index') }}" class="inline-flex items-center px-6 py-3 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 transition duration-200 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Explore Our Menu
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Cancel Order Modal -->
<div id="cancelOrderModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-xl overflow-hidden shadow-2xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-bold text-gray-900">Confirm Cancellation</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6">Are you sure you want to cancel this order? Any payment made will be refunded according to our policy.</p>
            <div class="flex justify-end space-x-3">
                <button id="closeModal" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    Go Back
                </button>
                <form id="cancelOrderForm" action="" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                        Confirm Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('cancelOrderModal');
    const closeModal = document.getElementById('closeModal');
    const cancelButtons = document.querySelectorAll('.cancel-order-btn');
    const cancelOrderForm = document.getElementById('cancelOrderForm');

    cancelButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            cancelOrderForm.action = this.getAttribute('data-action');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    closeModal.addEventListener('click', function () {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
});
</script>
@endsection
