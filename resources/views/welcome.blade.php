@extends('Layouts.master')

@section('title', 'Home')

@section('content')
<div class="bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/food-banner.jpg') }}');">
    <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
        <div class="text-center text-white">
            <h1 class="text-6xl font-bold mb-4">Welcome to FoodCircle</h1>
            <p class="text-2xl mb-6">Order your favorite meals from the best restaurants in town.</p>
            <a href="" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                Explore Menu
            </a>
        </div>
    </div>
</div>

<div class="py-10 bg-gray-50">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-10">Why Choose FoodCircle?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Fast Delivery -->
            <div class="text-center">
                <i class="ri-timer-fill text-red-500 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Fast Delivery</h3>
                <p>Get your food delivered hot and fresh in no time.</p>
            </div>
            <!-- Quality Food -->
            <div class="text-center">
                <i class="ri-restaurant-2-line text-red-500 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Quality Food</h3>
                <p>We partner with the best restaurants to ensure top quality meals.</p>
            </div>
            <!-- Easy to Use -->
            <div class="text-center">
                <i class="ri-smartphone-line text-red-500 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Easy to Use</h3>
                <p>Order your food with just a few clicks on our user-friendly platform.</p>
            </div>
        </div>
    </div>
</div>

<div class="py-10 bg-red-500 text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4">Hungry? Order Now!</h2>
        <p class="text-lg mb-6">Discover the best food from top restaurants near you.</p>
        <a href="" class="bg-white text-red-500 font-bold py-3 px-6 rounded-lg text-lg">
            Order Now
        </a>
    </div>
</div>
@endsection
