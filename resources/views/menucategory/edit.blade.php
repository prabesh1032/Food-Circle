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
