@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold mb-4">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add</a>
        </div>

        <table class="table-auto w-full border text-center">
            <thead>
            <tr>
                <th class="border px-4 py-2">№</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Quantity</th>
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
    </div>
@endsection
