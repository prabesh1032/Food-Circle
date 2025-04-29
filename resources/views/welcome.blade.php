@extends('Layouts.master')

@section('title', 'Home')

@section('content')

<!-- Hero Section with Animated Text -->
<div class="bg-cover bg-center h-screen relative overflow-hidden" style="background-image: url('{{ asset('foodcircle.jpg') }}');">
    <!-- Animated floating food elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
        <div class="absolute top-20 left-10 w-16 h-16 bg-yellow-400 rounded-full opacity-20 animate-float1"></div>
        <div class="absolute top-1/3 right-20 w-12 h-12 bg-cyan-400 rounded-full opacity-20 animate-float2"></div>
        <div class="absolute bottom-1/4 left-1/4 w-14 h-14 bg-white rounded-full opacity-20 animate-float3"></div>
    </div>

    <div class="flex items-center justify-center h-full bg-black bg-opacity-60">
        <div class="text-center text-white px-4">
            <h1 class="text-6xl md:text-7xl font-extrabold mb-6 animate-fade-in">
                Welcome to <span class="text-cyan-400 animate-pulse">FoodCircle Café</span>
            </h1>
            <p class="text-2xl md:text-3xl font-semibold mb-8 animate-slide-up">
                Fresh meals, fast service — only at <span class="text-yellow-400">FoodCircle</span>.
            </p>
            <a href="{{ route('menu') }}" class="inline-block bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full text-xl shadow-lg transition duration-300 transform hover:scale-105 animate-bounce">
                Explore Menu
            </a>
        </div>
    </div>

    <!-- Scroll down indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</div>

<!-- Why Choose FoodCircle Section -->
<section class="py-16 bg-black text-gray-300 relative">
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-cyan-400 to-yellow-400"></div>

    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-cyan-400 mb-12">Why Choose FoodCircle?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Fast Delivery -->
            <div class="text-center p-6 hover:bg-gray-800 rounded-lg transition transform hover:-translate-y-2 hover:shadow-lg">
                <div class="relative inline-block">
                    <i class="ri-timer-flash-line text-yellow-400 text-7xl mb-6"></i>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full animate-ping">Fast!</span>
                </div>
                <h3 class="text-2xl font-bold text-cyan-400 mb-4">Lightning Fast Delivery</h3>
                <p class="text-gray-400">Average delivery time: <span class="font-bold text-white">25 minutes</span></p>
            </div>

            <!-- Fresh & Tasty Meals -->
            <div class="text-center p-6 hover:bg-gray-800 rounded-lg transition transform hover:-translate-y-2 hover:shadow-lg">
                <i class="ri-restaurant-2-line text-yellow-400 text-7xl mb-6"></i>
                <h3 class="text-2xl font-bold text-cyan-400 mb-4">Fresh & Tasty Meals</h3>
                <p class="text-gray-400">Daily prepared with <span class="font-bold text-white">organic ingredients</span></p>
            </div>

            <!-- Easy Ordering -->
            <div class="text-center p-6 hover:bg-gray-800 rounded-lg transition transform hover:-translate-y-2 hover:shadow-lg">
                <i class="ri-smartphone-line text-yellow-400 text-7xl mb-6"></i>
                <h3 class="text-2xl font-bold text-cyan-400 mb-4">Easy Online Ordering</h3>
                <p class="text-gray-400">Just <span class="font-bold text-white">3 clicks</span> to get your food</p>
            </div>
        </div>
    </div>
</section>
<!-- Call to Action with Parallax Effect -->
<section class="py-32 bg-fixed bg-center bg-cover relative" style="background-image: url('{{ asset('foodcircle2.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="container mx-auto text-center relative z-10 px-6">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to Taste the Difference?</h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">Join thousands of happy customers enjoying our delicious meals</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('menu') }}" class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full text-lg shadow-lg transition duration-300">
                Order Now
            </a>
            <a href="#" class="bg-transparent hover:bg-white/10 text-white font-bold py-3 px-8 rounded-full text-lg border-2 border-white transition duration-300">
                Our Story
            </a>
        </div>
    </div>
</section>

<!-- App Download Section -->
<section class="py-16 bg-gray-900 text-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-3xl font-bold mb-4">Get the FoodCircle App</h2>
                <p class="text-gray-300 mb-6">Download our app for exclusive deals and faster ordering</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg flex items-center justify-center transition">
                        <i class="ri-apple-fill text-2xl mr-2"></i>
                        <div class="text-left">
                            <div class="text-xs">Download on the</div>
                            <div class="text-lg font-semibold">App Store</div>
                        </div>
                    </a>
                    <a href="#" class="bg-black hover:bg-gray-800 text-white px-6 py-3 rounded-lg flex items-center justify-center transition">
                        <i class="ri-google-play-fill text-2xl mr-2"></i>
                        <div class="text-left">
                            <div class="text-xs">Get it on</div>
                            <div class="text-lg font-semibold">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('app-mockup.png') }}" alt="FoodCircle App" class="max-w-xs md:max-w-md">
            </div>
        </div>
    </div>
</section>

@endsection
