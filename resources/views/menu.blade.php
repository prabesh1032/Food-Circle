<!-- resources/views/menu.blade.php -->

@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6">

        @if($menus->isEmpty())
            <p class="text-center text-lg text-gray-500 mt-6">No menus available.</p>
        @else
            @foreach($categories as $category)
                <!-- Category Name -->
                <h2 class="text-4xl text-center font-extrabold text-black mt-8 mb-6">{{ $category->name }}
                    @if($category->icon)
                        <span class="text-red-600 text-4xl inline-block ml-2">{!! $category->icon !!}</span>
                    @endif
                </h2>

                <!-- Menu Items for this Category -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @foreach($menus->where('category_id', $category->id) as $menu)
                        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
                            <!-- Menu Image -->
                            <img src="{{ asset('menus/'.$menu->image) }}" alt="{{ $menu->name }}" class="w-full h-64 object-cover rounded-lg">

                            <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ $menu->name }}</h2>
                            <p class="text-gray-600 mt-2">{{ $menu->description }}</p>
                            <p class="text-xl font-semibold text-gray-900 mt-4">${{ number_format($menu->price, 2) }}</p>

                            <!-- Availability Status -->
                            <span class="px-3 py-1 inline-block rounded-full text-sm font-medium mt-2
                                {{ $menu->is_available ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $menu->is_available ? 'Available' : 'Unavailable' }}
                            </span>

                            <div class="flex justify-between items-center mt-6">
                                <!-- Order Now Button -->
                                <a href="{{ route('viewmenu', $menu->id) }}" class="bg-blue-500 text-white py-2 px-6 rounded-full hover:bg-blue-700 transition-all">
                                    <i class="ri-shopping-cart-2-line text-xl mr-2"></i> Order Now
                                </a>

                                <!-- See More Button -->
                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                    <i class="ri-eye-line text-xl"></i> See More
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
@endsection
