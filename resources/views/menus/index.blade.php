@extends('layouts.app')

@section('title', 'Menus')

@section('content')
    <div class="mb-5 flex justify-between items-center">
        <h1 class="text-3xl font-semibold">Menu Management</h1>
        <a href="{{ route('menus.create') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg flex items-center space-x-2 hover:bg-blue-700 transition duration-300">
            <i class="ri-add-line text-lg"></i>
            <span>Add New Menu</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($menus as $menu)
            <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                @if($menu->image)
                    <img src="{{ asset('menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-40 object-cover">
                @else
                    <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                        <i class="ri-image-line text-4xl"></i>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-semibold inline-block">
                        {{ $menu->name }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $menu->menuCategory->name }}
                        @if($menu->menuCategory->icon)
                        <span class="text-red-600 text-xl inline-block ml-2">{!! $menu->menuCategory->icon !!}</span>
                    @endif
                    </p>
                    <p class="text-xl font-bold text-cyan-600">₹{{ number_format($menu->price, 2) }}</p>
                    <span class="px-3 py-1 inline-block rounded-full text-sm font-medium mt-2
                        {{ $menu->is_available ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $menu->is_available ? 'Available' : 'Unavailable' }}
                    </span>
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                            <i class="ri-edit-2-line"></i><span>Edit</span>
                        </a>
                        <a href="{{ route('menus.destroy', $menu->id) }}"
                            class="text-red-600 hover:text-red-800 flex items-center space-x-1"
                            onclick="return confirm('Are you sure you want to delete this category?')">
                             <i class="ri-delete-bin-5-line text-xl mr-2"></i> Delete
                         </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

