@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold mb-4">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add</a>
        </div>

        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap gap-4 mb-6">

            <input type="text" name="search" placeholder="Search by name"
                   value="{{ request('search') }}"
                   class="border px-3 py-2 rounded w-48">

            <select name="category_id" class="border px-3 py-2 rounded w-48">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <input type="number" step="0.01" name="price_from" placeholder="Price from"
                   value="{{ request('price_from') }}"
                   class="border px-3 py-2 rounded w-32">

            <input type="number" step="0.01" name="price_to" placeholder="Price to"
                   value="{{ request('price_to') }}"
                   class="border px-3 py-2 rounded w-32">

            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Filter
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="text-gray-600 underline px-3 py-2">Reset</a>
        </form>


        <table class="table-auto w-full border text-center">
            <thead>
            <tr>
                <th class="border px-4 py-2">№</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Quantity</th>
                <th class="border px-4 py-2">Image</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $product->price }}</td>
                    <td class="border px-4 py-2">{{ $product->stock }}</td>
                    <td class="border px-4 py-2">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="image"
                                 class="w-16 h-16 object-cover mx-auto block">
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-green-500">Edit</a>
                        |
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2 text-center">No products yet</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->appends(request()->query())->links() }}
        </div>

    </div>
@endsection
