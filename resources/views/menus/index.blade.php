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

    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="min-w-full text-left border-collapse border border-gray-300">
            <thead class="bg-cyan-500 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Price</th>
                    <th class="border border-gray-300 px-4 py-2">Availability</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $menu->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $menu->menuCategory->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">₹{{ number_format($menu->price, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="px-2 py-1 rounded-lg text-sm
                                {{ $menu->is_available ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ $menu->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                                <i class="ri-edit-2-line"></i><span>Edit</span>
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 flex items-center space-x-1 mt-2">
                                    <i class="ri-delete-bin-6-line"></i><span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
