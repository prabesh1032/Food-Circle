<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - FoodCircle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-300">
    <!-- Alert --> @include('layouts.alert')
    <div class="flex justify-between px-20 bg-cyan-600 text-black py-2">
        <div>
            <a href="{{ route('menu') }}" class="text-lg font-semibold hover:text-yellow-500">
                <i class="ri-restaurant-fill"></i> Delicious Deals
            </a>
        </div>
        <div class="flex items-center justify-center space-x-6">
            @auth
                <!-- Display user's name and my orders link -->
                <a href="" class="text-lg font-semibold hover:text-yellow-500">
                    <i class="ri-user-fill"></i> Hi, {{ auth()->user()->name }}
                </a>
                <a href="" class="p-3 text-lg font-semibold hover:text-yellow-500">
                    <i class="ri-file-list-3-line"></i> My Orders
                </a>

                <!-- Add My Cart link with cart count -->
                <a href="{{ route('cart.index') }}" class="p-3 text-lg font-semibold hover:text-yellow-500 relative">
                    <i class="ri-shopping-cart-2-line"></i> My Cart
                    @php
                        $cartCount = session('cart', []);
                        $itemCount = count($cartCount);
                    @endphp
                    @if($itemCount > 0)
                        <span class="absolute top-0 right-0 text-xs font-semibold text-white bg-red-500 rounded-full w-5 h-5 flex items-center justify-center">{{ $itemCount }}</span>
                    @endif
                </a>

                <!-- Logout form -->
                <form action="{{ route('logout') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="p-3 text-lg font-semibold hover:text-yellow-500">
                        <i class="ri-logout-box-line"></i> Logout
                    </button>
                </form>
            @else
                <!-- Login link -->
                <a href="/login" class="p-3 text-lg font-semibold hover:text-yellow-500">
                    <i class="ri-login-box-line"></i> Login
                </a>
            @endauth
        </div>
    </div>
    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-3 bg-black shadow-md sticky top-0 z-10">
        <div>
            <a href="{{ route('home') }}">
                <img src="{{ asset('logo-foodcircle.png') }}" alt="Logo" class="w-20 h-20 object-cover rounded-full transform transition duration-200 ease-in-out hover:scale-105" />
            </a>
        </div>
        <div class="flex space-x-6">
            <a href="{{ route('home') }}" class="text-lg text-cyan-400 font-semibold hover:text-yellow-500 flex items-center space-x-2 p-2 transition duration-300 ease-in-out">
                <i class="ri-home-2-line"></i> <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="text-lg font-semibold text-cyan-400 hover:text-yellow-500 flex items-center space-x-2 p-2 transition duration-300 ease-in-out">
                <i class="ri-information-line"></i> <span>About Us</span>
            </a>
            <a href="{{ route('menu') }}" class="text-lg font-semibold text-cyan-400 hover:text-yellow-500 flex items-center space-x-2 p-2 transition duration-300 ease-in-out">
                <i class="ri-restaurant-2-line"></i> <span>Menu</span>
            </a>
            <a href="{{ route('contact') }}" class="text-lg font-semibold text-cyan-400 hover:text-yellow-500 flex items-center space-x-2 p-2 transition duration-300 ease-in-out">
                <i class="ri-contacts-line"></i> <span>Contact</span>
            </a>
        </div>
    </nav>
    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-black py-6 shadow-lg">
        <div class="container mx-auto flex flex-wrap justify-between items-center px-10">
            <!-- Contact Us -->
            <div class="text-center md:text-left mb-4 md:mb-0">
                <h2 class="text-2xl font-bold text-cyan-400 mb-2">Contact Us</h2>
                <p class="text-xl font-semibold hover:text-yellow-500 flex items-center space-x-2 p-2">
                    <i class="ri-mail-line mr-2"></i>
                    <a href="mailto:foodcircle@gmail.com" class="hover:text-yellow-500">foodcircle@gmail.com</a>
                </p>
                <p class="text-xl font-semibold hover:text-yellow-500 flex items-center space-x-2 p-2">
                    <i class="ri-phone-fill mr-2"></i>
                    <a href="tel:+9742538007" class="hover:text-yellow-500">9812965119</a>
                </p>
            </div>

            <!-- Social Links -->
            <div class="flex space-x-4 justify-center md:justify-end">
                <a href="#" class="text-2xl text-cyan-400 hover:text-gold-500"><i class="ri-facebook-fill"></i></a>
                <a href="#" class="text-2xl text-cyan-400 hover:text-gold-500"><i class="ri-twitter-fill"></i></a>
                <a href="#" class="text-2xl text-cyan-400 hover:text-gold-500"><i class="ri-instagram-fill"></i></a>
                <a href="#" class="text-2xl text-cyan-400 hover:text-gold-500"><i class="ri-linkedin-box-fill"></i></a>
            </div>
        </div>
        <div class="bg-cyan-600 text-center py-3 mt-4">
            <p class="text-lg font-semibold text-black">&copy; 2024 FoodCircle. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
