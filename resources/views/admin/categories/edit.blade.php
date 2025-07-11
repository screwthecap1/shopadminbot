@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white shadow rounded p-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name', $category->name) }}"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Description</label>
                <input type="text" id="description" name="description"
                       value="{{ old('description', $category->description) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="text-blue-500 px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.categories.index') }}" class="text-gray-500 ml-2">Cancel</a>
        </form>
    </div>
@endsection
