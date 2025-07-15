@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 flex justify-center">
        <form action="{{ route('admin.categories.store') }}" method="POST"
              class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4">Add category</h1>

            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" required
                       value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <input type="text" name="description" id="description" class="w-full border px-4 py-2 rounded" required
                       value="{{ old('description') }}">
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center mt-4 space-x-4">
                <button type="submit" class="px-4 py-2 rounded text-white bg-green-500 hover:bg-green-600 transition">Save</button>
                <a href="{{ route('admin.categories.index') }}"
                   class="px-4 py-2 rounded text-gray-700 bg-gray-200 hover:bg-gray-300 transition inline-flex items-center justify-center">
                    Cancel
                </a>
            </div>

        </form>
    </div>
@endsection
