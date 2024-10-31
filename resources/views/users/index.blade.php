@extends('layouts.app')

@section('title', 'User List')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">User List</h1>

<!-- Task Status: Display success message if a session has 'success' -->
@if(session('success'))
<div id="success-message" class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- Add User Button -->
<a href="{{ route('users.create') }}" class="bg-green-500 text-white font-semibold px-4 py-2 rounded inline-block transition-opacity duration-200 hover:opacity-50">Add New User</a>

<!-- User Count Display -->
<div class="flex justify-end mb-4">
    <span class="text-gray-600 font-semibold">Total Users: {{ $users->total() }}</span>
</div>

@if($users->isEmpty())
<!-- Display Message if No Users are Available -->
<div class="flex items-center justify-center h-64">
    <p class="text-gray-500 text-center text-2xl font-bold">No users available...</p>
</div>
@else
<!-- User Table -->
<table class="table-auto w-full mt-4 border border-gray-700">
    <thead>
    <tr class="bg-gray-200">
        <!-- Table Headers for User Details -->
        <th class="border px-2 py-2 w-16 text-center">ID</th>
        <th class="border px-4 py-2 text-center">Name</th>
        <th class="border px-4 py-2 text-center">Email</th>
        <th class="border px-4 py-2" style="width: 30%;">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <!-- User Details in Rows -->
        <td class="border px-2 py-2 text-center">{{ $user->id }}</td>
        <td class="border px-4 py-2 text-center">{{ $user->name }}</td>
        <td class="border px-4 py-2 text-center">{{ $user->email }}</td>
        <td class="border px-4 py-2 text-center" style="width: 30%;">
            <!-- Action Buttons for Each User -->
            <a href="{{ route('users.show', $user->id) }}" class="bg-blue-500 text-white px-2 py-2 rounded font-bold text-sm inline-block w-20 mr-2 transition-opacity duration-200 hover:opacity-50">View</a>
            <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-2 py-2 rounded font-bold text-sm inline-block w-20 mr-2 transition-opacity duration-200 hover:opacity-50">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded font-bold text-sm w-20 text-center transition-opacity duration-200 hover:opacity-50">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<!-- Pagination Controls -->
<div class="mt-4">
    {{ $users->links() }}
</div>

@endif

<!-- Success Message Auto-hide Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = 'opacity 0.5s ease';
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 500);
            }, 3000);
        }
    });
</script>

@endsection
