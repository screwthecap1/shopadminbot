@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST"
              class="bg-white p-4 shadow rounded w-full max-w-lg mx-auto" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2"
                       value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium">Description</label>
                <textarea name="description" id="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="w-full border rounded px-3 py-2"
                       value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-4">
                <label for="stock" class="block font-medium">Stock</label>
                <input type="number" name="stock" id="stock" class="w-full border rounded px-3 py-2"
                       value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium">Image</label>
                <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2">
            </div>


            <div class="mb-4">
                <label for="category_id" class="block font-medium">Category</label>
                <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-center mt-4 space-x-4">
                <button type="submit"
                        class="px-4 py-2 rounded text-white bg-green-500 hover:bg-green-600 transition">Update</button>
                <a href="{{ route('admin.products.index') }}"
                   class="px-4 py-2 rounded text-gray-700 bg-gray-200 hover:bg-gray-300 transition">Cancel</a>
            </div>
        </form>
    </div>
@endsection
