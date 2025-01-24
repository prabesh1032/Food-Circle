@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Menu Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Menu Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}"
                class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('name')
                <div class="text-red-500 text-sm mt-1">*{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description"
                class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $menu->description) }}</textarea>
            @error('description')
                <div class="text-red-500 text-sm mt-1">*{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="price" name="price" value="{{ old('price', $menu->price) }}" step="0.01"
                class="mt-1 p-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('price')
                <div class="text-red-500 text-sm mt-1">*{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category_id" name="category_id"
                class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-500 text-sm mt-1">*{{ $message }}</div>
            @enderror
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" name="image"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <div class="mt-2">
                @if($menu->image)
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="h-24 w-24 rounded-md">
                @else
                    <p class="text-sm text-gray-500">No image uploaded.</p>
                @endif
            </div>
            @error('image')
                <div class="text-red-500 text-sm mt-1">*{{ $message }}</div>
            @enderror
        </div>

        <!-- Availability -->
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_available" value="1"
                    {{ old('is_available', $menu->is_available) ? 'checked' : '' }}
                    class="form-checkbox h-5 w-5 text-blue-600">
                <span class="ml-2 text-gray-700">Available</span>
            </label>
        </div>

        <!-- Buttons -->
        <div class="flex space-x-3">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-500 flex items-center space-x-2">
                <i class="ri-check-line"></i>
                <span>Update Menu</span>
            </button>
            <a href="{{ route('menus.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-gray-400 flex items-center space-x-2">
                <i class="ri-close-line"></i>
                <span>Cancel</span>
            </a>
        </div>
    </form>
@endsection
