@extends('Layouts.master')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<div class="bg-cover bg-center h-96" style="background-image: url('{{ asset('foodcircle.jpg') }}');">
    <div class="flex items-center justify-center h-full bg-black bg-opacity-70">
        <div class="text-center text-white">
            <h1 class="text-6xl font-extrabold mb-4">About <span class="text-cyan-400">FoodCircle</span></h1>
            <p class="text-2xl font-extrabold">Delivering happiness one meal at a time!</p>
        </div>
    </div>
</div>

<!-- Mission Section -->
<div class="py-16 bg-black text-gray-300">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center text-cyan-400 mb-10">Our Mission</h2>
        <div class="text-center max-w-4xl mx-auto">
            <p class="text-xl leading-relaxed">
                At <span class="text-cyan-400 font-bold">FoodCircle</span>, our mission is to connect food lovers with their favorite restaurants. We strive to provide a seamless and delightful experience with every meal delivered hot and fresh to your doorstep.
                <br> We believe good food creates memories, and we are here to ensure your cravings are met, anytime and anywhere.
            </p>
        </div>
    </div>
</div>

<!-- What Sets Us Apart Section -->
<div class="py-16 bg-cyan-400 text-black">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center mb-10">What Sets Us Apart?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Quality -->
            <div class="text-center">
                <i class="ri-star-fill text-gold-500 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Top Quality</h3>
                <p>We ensure every meal meets the highest standards of taste and quality.</p>
            </div>
            <!-- Innovation -->
            <div class="text-center">
                <i class="ri-lightbulb-flash-line text-gold-500 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Innovative Platform</h3>
                <p>Our user-friendly platform is designed for a seamless ordering experience.</p>
            </div>
            <!-- Community -->
            <div class="text-center">
                <i class="ri-community-line text-gold-500 text-6xl mb-4"></i>
                <h3 class="text-2xl font-bold mb-2">Community Focused</h3>
                <p>We support local businesses and bring communities closer through food.</p>
            </div>
        </div>
    </div>
</div>

<!-- Our Story Section -->
<div class="py-16 bg-black text-gray-300">
    <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center text-cyan-400 mb-10">Our Story</h2>
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 mb-8 md:mb-0">
                <img src="{{ asset('foodcircle2.jpg') }}" alt="Our Story" class="rounded-lg shadow-lg mx-auto">
            </div>
            <div class="w-full md:w-1/2 text-center md:text-left px-6">
                <p class="text-xl leading-relaxed">
                    <span class="text-cyan-400 font-bold">FoodCircle</span> started with a simple idea: to make food ordering effortless and enjoyable. What began as a small venture has now grown into a platform that connects thousands of people to the food they love.
                    <br><br> With a passion for culinary excellence and a commitment to customer satisfaction, we are proud to bring the best dining experiences to your table.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="py-10 bg-cyan-400 text-black">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Order?</h2>
        <p class="text-lg mb-6">Join the FoodCircle family and explore a world of delicious meals.</p>
        <a href="" class="bg-black hover:bg-gold-500 text-white font-bold py-3 px-6 rounded-lg text-lg shadow-lg">
            Order Now
        </a>
    </div>
</div>
@endsection
