@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST"
              class="bg-white p-6 rounded shadow-md w-full max-w-md">
            @csrf

            <div class="md-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full border px-4 py-2 rounded" required
                       value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md-4">
                <label for="description" class="block text-gray-700">Description</label>
                <input type="text" name="description" id="description" class="w-full border px-4 py-2 rounded" required
                       value="{{ old('description') }}">
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="text-green-500 px-4 py-2 rounded">Save</button>
            <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-500">Cancel</a>
        </form>
    </div>
@endsection
