@extends('layouts.master')

@section('content')
<div class="bg-gradient-to-b from-yellow-50 to-white min-h-screen">
    <!-- Hero Section -->
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-gray-900 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <div class="pt-10 sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden">
                    <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                                <span class="block">Our Delicious</span>
                                <span class="block text-yellow-400">Menu Selection</span>
                            </h1>
                            <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Handcrafted with love using the freshest ingredients. Every bite tells a story.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Delicious food">
        </div>
    </div>

    <!-- Menu Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Category Navigation -->
        <div class="flex overflow-x-auto pb-4 mb-8 scrollbar-hide">
            <div class="flex space-x-4">
                @foreach($categories as $category)
                <a href="#{{ Str::slug($category->name) }}" class="flex-shrink-0 px-6 py-2 rounded-full bg-white shadow-md hover:bg-yellow-50 transition-colors duration-200 flex items-center">
                    @if($category->icon)
                    <span class="mr-2 text-yellow-500 text-xl">{!! $category->icon !!}</span>
                    @endif
                    <span class="font-medium text-gray-800">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>

        @if($menus->isEmpty())
        <div class="text-center py-16">
            <div class="inline-block p-4 bg-yellow-100 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Menu Coming Soon!</h2>
            <p class="text-gray-600 mb-6">We're preparing something special for you. Check back later!</p>
        </div>
        @else
        <!-- Menu Sections -->
        <div class="space-y-16">
            @foreach($categories as $category)
            @if($menus->where('category_id', $category->id)->count() > 0)
            <section id="{{ Str::slug($category->name) }}" class="scroll-mt-16">
                <div class="flex items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                        @if($category->icon)
                        <span class="text-yellow-500 mr-3">{!! $category->icon !!}</span>
                        @endif
                        {{ $category->name }}
                    </h2>
                    <div class="ml-4 h-px flex-1 bg-gray-300"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($menus->where('category_id', $category->id) as $menu)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Menu Image with Badge -->
                        <div class="relative">
                            <img src="{{ asset('menus/'.$menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                            @if(!$menu->is_available)
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                SOLD OUT
                            </div>
                            @endif
                            @if($menu->is_new)
                            <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                NEW!
                            </div>
                            @endif
                        </div>

                        <!-- Menu Details -->
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold text-gray-900">{{ $menu->name }}</h3>
                                <p class="text-lg font-bold text-yellow-600">${{ number_format($menu->price, 2) }}</p>
                            </div>

                            <p class="mt-2 text-gray-600">{{ Str::limit($menu->description, 100) }}</p>

                            <!-- Dietary Tags -->
                            @if($menu->tags)
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach(explode(',', $menu->tags) as $tag)
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="mt-6 flex justify-between items-center">
                                <a href="{{ route('viewmenu', $menu->id) }}" class="flex-1 mr-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg text-center transition-colors duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Order
                                </a>
                                <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
            @endforeach
        </div>
        @endif
    </div>

    <!-- Special Offers Banner -->
    <div class="bg-yellow-500 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-900">Special Weekend Offer!</h3>
                    <p class="text-gray-800">Get 15% off on all orders above $30</p>
                </div>
                <button class="px-6 py-3 bg-gray-900 text-white rounded-lg font-medium hover:bg-gray-800 transition-colors duration-200">
                    View All Offers
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
