<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FoodCircle') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        @include('layouts.alert')

        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 h-screen bg-black text-white sticky top-0 px-1 py-1">
                <div class="flex items-center justify-center mb-10">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('logo-foodcircle.png') }}" alt="FoodCircle Logo" class="w-5/12">
                    </a>
                </div>
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-lg hover:bg-cyan-500 hover:text-black p-3 rounded-md">
                        <i class="ri-dashboard-line text-xl"></i>
                        <span>Dashboard</span>
                    </a>
                    <!-- Restaurants -->
                    <a href="{{ route('menucategory.index') }}" class="flex items-center space-x-3 text-lg hover:bg-cyan-500 hover:text-black p-3 rounded-md">
                        <i class="ri-restaurant-line text-xl"></i>
                        <span>Menu Categories:</span>
                    </a>
                    <!-- Menus -->
                    <a href="{{ route('menus.index') }}" class="flex items-center space-x-3 text-lg hover:bg-cyan-500 hover:text-black p-3 rounded-md">
                        <i class="ri-menu-line text-xl"></i>
                        <span>Menus</span>
                    </a>
                    <!-- Orders -->
                    <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 text-lg hover:bg-cyan-500 hover:text-black p-3 rounded-md">
                        <i class="ri-file-list-3-line text-xl"></i>
                        <span>Orders</span>
                    </a>
                    <!-- Customers -->
                    <a href="{{ route('customers.index') }}" class="flex items-center space-x-3 text-lg hover:bg-cyan-500 hover:text-black p-3 rounded-md">
                        <i class="ri-user-3-line text-xl"></i>
                        <span>Customers</span>
                    </a>
                    <!-- Feedback -->
                    <a href="" class="flex items-center space-x-3 text-lg hover:bg-cyan-500 hover:text-black p-3 rounded-md">
                        <i class="ri-feedback-line text-xl"></i>
                        <span>Feedback</span>
                    </a>

                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full hover:bg-red-700 hover:text-white p-3 rounded-md text-lg">
                            <i class="ri-logout-box-line text-xl"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 bg-gray-100 p-10">
                <h1 class="text-4xl font-bold text-cyan-400">@yield('title')</h1>
                <hr class="my-5 border-t-4 border-yellow-500">
                @yield('content')
            </div>
        </div>
    </body>
</html>
