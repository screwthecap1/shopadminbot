@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Panel</h1>

    <div class="bg-white shadow rounded p-4">
        <h2 class="text-xl font-semibold mb-2">User's List</h2>
        <table class="table-auto w-full border">
            <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ $user->is_admin ? 'admin' : 'user' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
