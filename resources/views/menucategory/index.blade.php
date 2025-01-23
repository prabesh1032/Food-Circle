@extends('layouts.app')

@section('title', 'Menu Categories')

@section('content')
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('menucategory.create') }}" class="flex items-center bg-gradient-to-r from-cyan-500 to-blue-500 text-white py-3 px-8 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
            <i class="ri-add-line text-xl mr-2"></i><span class="font-medium">Add New Category</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white py-3 px-6 rounded-lg mb-5 shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Section -->
    <div class="overflow-x-auto bg-white shadow-xl rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-cyan-400 to-blue-400 text-white text-left">
                <tr>
                    <th class="py-4 px-6">#</th>
                    <th class="py-4 px-6">Name</th>
                    <th class="py-4 px-6">Priority</th>
                    <th class="py-4 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border-b hover:bg-gray-50 transition-all duration-200">
                        <td class="py-3 px-6 text-center">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6">{{ $category->name }}</td>
                        <td class="py-3 px-6 text-center">{{ $category->priority }}</td>
                        <td class="py-3 px-6 flex space-x-4">
                            <!-- Edit Button -->
                            <a href="{{ route('menucategory.edit', $category->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full flex items-center space-x-2 shadow-md transition-all duration-300 transform hover:scale-105">
                                <i class="ri-edit-2-line"></i><span>Edit</span>
                            </a>

                            <!-- Delete Button -->
                            <a href="{{ route('menucategory.destroy', $category->id) }}"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full flex items-center space-x-2 shadow-md transition-all duration-300 transform hover:scale-105"
                                onclick="return confirm('Are you sure you want to delete this category?')">
                                 <i class="ri-delete-bin-5-line text-xl mr-2"></i> Delete
                             </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
