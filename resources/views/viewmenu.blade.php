@extends('layouts.master')

@section('content')
<div class="container mx-auto p-8">
    <!-- Menu Title -->
    <h1 class="text-5xl font-extrabold text-center text-gray-900 mb-4">{{ $menu->name }}</h1>
    <p class="text-center font-bold text-lg text-gray-600">Explore delicious dishes from the {{ $menu->category }} category!</p>

    <!-- Menu Direct Order Section -->
<form method="POST" action="{{ route('direct.checkout') }}" class="mt-8">
    @csrf
    <input type="hidden" name="menu_id" value="{{ $menu->id }}">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Menu Image Section -->
        <div class="p-4 bg-white">
            <img src="{{ asset('menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="rounded-lg shadow-lg w-full h-64 object-cover transition-transform duration-300 hover:scale-105">
            <a href="#" class="block bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-center mt-6 px-6 py-3 rounded-md shadow-lg hover:from-indigo-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105">
                Learn More About This Menu
            </a>
        </div>

        <!-- Menu Quantity and Details Section -->
        <div class="p-6 bg-white">
            <div class="space-y-4">
                <p class="text-lg text-gray-900 flex items-center">
                    <i class="ri-price-tag-line text-green-500 text-xl mr-3"></i>
                    <span><strong>Price:</strong> ${{ number_format($menu->price, 2) }} <span class="text-sm font-bold text-gray-600">Per Item</span></span>
                </p>

                <label for="quantity" class="block text-lg text-gray-900 font-bold mt-4">
                    <i class="ri-archive-line text-red-500 text-xl mr-3"></i> Quantity:
                </label>
                <input type="number" id="quantity" name="quantity" class="w-full p-3 border text-black font-bold rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" min="1" value="1" required>

            <div class="bg-white py-2 px-2 shadow-lg mt-8">
                <div class="text-center">
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white mb-2 px-8 py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 flex items-center">
                        <i class="ri-shopping-cart-line mr-2"></i> Order Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Sidebar Section -->
<div class="p-4 bg-white">
    <div class="space-y-4">
        <!-- Popular Categories -->
        <a href="" class="block p-6 bg-red-50 border-l-4 border-red-500 text-red-700 hover:bg-red-200 transition-all duration-300 rounded-lg shadow-md">
            <p class="font-bold text-xl">Popular Categories</p>
            <p class="text-sm mt-1">Browse the most-loved food categories.</p>
        </a>

        <!-- Trending Dishes -->
        <a href="" class="block p-6 bg-purple-50 border-l-4 border-purple-500 text-purple-700 hover:bg-purple-200 transition-all duration-300 rounded-lg shadow-md">
            <p class="font-bold text-xl">Trending Dishes</p>
            <p class="text-sm mt-1">Check out what others are ordering today!</p>
        </a>

        <!-- User Recommendations -->
        <a href="" class="block p-6 bg-orange-50 border-l-4 border-orange-500 text-orange-700 hover:bg-orange-200 transition-all duration-300 rounded-lg shadow-md">
            <p class="font-bold text-xl">Recommended for You</p>
            <p class="text-sm mt-1">Personalized dishes based on your taste.</p>
        </a>
    </div>
</div>

        </div>
    </form>

    <!-- Related Menus Section -->
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Related Items</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedmenus as $relatedmenu)
                <div class="border border-gray-200 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:shadow-xl">
                    <a href="{{ route('viewmenu', $relatedmenu->id) }}">
                        <img src="{{ asset('menus/' . $relatedmenu->image) }}" alt="{{ $relatedmenu->name }}" class="h-56 w-full object-cover transition-transform duration-300 hover:scale-105">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $relatedmenu->name }}</h3>
                            <p class="text-gray-600 mt-2">Rs. {{ number_format($relatedmenu->price, 2) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
