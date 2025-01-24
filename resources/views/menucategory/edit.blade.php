@extends('layouts.app')

@section('title', 'Edit Menu Category')

@section('content')
    <h2 class="text-2xl font-semibold mb-5">Edit Menu Category</h2>

    <form action="{{ route('menucategory.update', $category->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')  <!-- Specify the HTTP method as PUT for updating -->

        <!-- Category Name -->
        <div class="form-group">
            <label for="name" class="text-lg">Category Name</label>
            <input type="text" name="name" id="name" class="form-control p-3 w-full rounded-lg"
                   placeholder="Enter Category Name" value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="text-red-600 mt-2 text-sm">
                    *{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Priority -->
        <div class="form-group">
            <label for="priority" class="text-lg">Priority</label>
            <input type="number" name="priority" id="priority" class="form-control p-3 w-full rounded-lg"
                   placeholder="Enter Priority" value="{{ old('priority', $category->priority) }}">
            @error('priority')
                <div class="text-red-600 mt-2 text-sm">
                    *{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Icon Input -->
        <div class="mb-4">
            <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Remix Icon Class)</label>
            <input type="text" name="icon" id="icon" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   value="{{ old('icon', $category->icon) }}" placeholder="e.g., ri-pizza-line">
            <p class="text-sm text-gray-500 mt-1">Enter the Remix icon class name (e.g., <strong>ri-pizza-line</strong>)</p>
            @error('icon')
                <div class="text-red-600 mt-2 text-sm">
                    *{{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-center space-x-4">
            <button type="submit" class="bg-blue-600 text-white py-3 px-5 rounded-md font-bold">
                Update Category
            </button>
            <a href="{{ route('menucategory.index') }}" class="bg-lime-500 text-white py-3 px-5 rounded-md font-bold">
                Cancel
            </a>
        </div>
    </form>
@endsection
