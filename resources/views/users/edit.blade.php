@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">Edit User Form</h1>

<!-- Success Message: Displays confirmation if session contains a 'success' message -->
@if(session('success'))
<div id="success-message" class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- Edit User Form -->
<form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf
    @method('PUT')

    <!-- Name Input Field -->
    <div class="mb-6">
        <label for="name" class="block font-bold">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
               placeholder="Username*"
               class="border w-full p-2 mt-2 {{ $errors->has('name') ? 'border-red-500' : '' }}">
        <!-- Error Message for Name Field -->
        @error('name')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email Input Field -->
    <div class="mb-6">
        <label for="email" class="block font-bold">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
               placeholder="Email Address*"
               class="border w-full p-2 mt-2 {{ $errors->has('email') ? 'border-red-500' : '' }}">
        <!-- Error Message for Email Field -->
        @error('email')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded mt-3 transition-opacity duration-200 hover:opacity-50">Save Changes</button>
</form>

<!-- JavaScript for Success Message Auto-hide -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
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
