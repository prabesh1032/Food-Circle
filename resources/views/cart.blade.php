@extends('layouts.master')

@section('content')
<h1 class="text-black text-5xl text-center font-extrabold my-8">My Food Cart</h1>

<!-- Cart Items Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-4 px-5 md:px-16">
    @foreach($carts as $cart)
    <div class="p-5 border-2 border-yellow-500 shadow-lg rounded-lg bg-gradient-to-br from-cyan-100 to-white hover:shadow-xl hover:-translate-y-2 transform transition duration-300 ease-in-out">
        <!-- Food Image -->
        @if($cart->menu && $cart->menu->image)
        <img src="{{ asset('menus/' . $cart->menu->image) }}" alt="Food Image" class="w-full h-44 object-cover rounded-lg mb-4 shadow-md">
        @else
        <img src="{{ asset('images/default-food-placeholder.png') }}" alt="Food Image" class="w-full h-44 object-cover rounded-lg mb-4 shadow-md">
        @endif

        <div class="flex flex-col gap-2">
            <!-- Menu Item Name -->
            <h2 class="text-2xl font-bold text-black">{{ $cart->menu ? $cart->menu->name : 'Item Unavailable' }}</h2>

            <!-- Price -->
            <p class="text-gray-700 flex items-center gap-2 text-lg">
                <i class="ri-money-dollar-circle-line text-yellow-500"></i>
                <span class="font-medium">Price: ${{ number_format($cart->menu ? $cart->menu->price : 0, 2) }}</span>
            </p>

            <!-- Quantity -->
            <p class="text-gray-700 flex items-center gap-2 text-lg">
                <i class="ri-stack-line text-cyan-500"></i>
                <span>Quantity: <span class="font-medium">{{ $cart->quantity }}</span></span>
            </p>

            <!-- Total Price -->
            <p class="text-gray-900 font-semibold flex items-center gap-2 text-lg">
                <i class="ri-calculator-line text-yellow-500"></i>
                <span>Total: ${{ number_format(($cart->menu ? $cart->menu->price : 0) * $cart->quantity, 2) }}</span>
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-5">
            <!-- Remove Button -->
            <button onclick="showModal('{{ $cart->id }}')" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 shadow-md transition flex items-center gap-2">
                <i class="ri-delete-bin-line"></i> Remove
            </button>

            <!-- Order Now Button -->
            <a href="{{ route('cart.checkout', $cart->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 shadow-md transition flex items-center gap-2">
                <i class="ri-shopping-cart-line"></i> Order Now
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Empty Cart Message -->
@if($carts->isEmpty())
<div class="text-center mt-12 pb-12">
    <p class="text-xl font-semibold text-gray-700">Your food cart is empty. Start adding delicious dishes now!</p><br>
    <a href="{{ route('home') }}" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-300 shadow-md">
        Browse Menu
    </a>
</div>
@endif

<!-- Delete Confirmation Modal -->
<div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden items-center justify-center z-50" id="deleteModal">
    <form action="{{ route('cart.destroy') }}" method="POST" class="bg-white p-6 rounded-lg shadow-2xl max-w-md">
        @csrf
        @method('DELETE')
        <input type="hidden" name="dataid" id="cartId">
        <h1 class="text-2xl font-bold text-center text-yellow-500 mb-4">
            <i class="ri-error-warning-line text-yellow-600 mr-2"></i> Confirm Deletion
        </h1>
        <p class="text-gray-700 text-center mb-6">Are you sure you want to remove this item from your food cart? This action cannot be undone.</p>
        <div class="flex justify-center gap-5">
            <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-400 shadow-md">
                <i class="ri-check-line mr-2"></i> Yes, Delete
            </button>
            <button type="button" onclick="hideModal()" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-400 shadow-md">
                <i class="ri-close-line mr-2"></i> Cancel
            </button>
        </div>
    </form>
</div>

<script>
    // Hide modal
    function hideModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }

    // Show modal and set cart id
    function showModal(id) {
        document.getElementById('cartId').value = id;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
</script>
@endsection
