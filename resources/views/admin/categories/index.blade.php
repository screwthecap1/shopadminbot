@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold mb-4">Categories</h1>
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add</a>
        </div>

        <table class="table-auto w-full border text-center">
            <thead>
            <tr>
                <th class="border px-4 py-2">№</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $cat)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $cat->name }}</td>
                    <td class="border px-4 py-2">{{ $cat->description }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="text-orange-500">Edit</a>
                        |
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Delete?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="boreder px-4 py-2 text-center">No categories</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
