@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">Create User Form</h1>

<!-- User Form -->
<form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf

    <!-- Name Input Field -->
    <div class="mb-6">
        <label for="name" class="block font-bold">Name</label>
        <input type="text" id="name" name="name"
               placeholder="Username*"
               class="border w-full p-2 mt-2 {{ $errors->has('name') ? 'border-red-500' : '' }}"
               value="{{ old('name') }}">
        <!-- Display Error for Name Input -->
        @error('name')
        <span id="nameError" class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email Input Field -->
    <div class="mb-6">
        <label for="email" class="block font-bold">Email</label>
        <input type="email" id="email" name="email"
               placeholder="Email Address*"
               class="border w-full p-2 mt-2 {{ $errors->has('email') ? 'border-red-500' : '' }}"
               value="{{ old('email') }}">
        <!-- Display Error for Email Input -->
        @error('email')
        <span id="emailError" class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded mt-3 transition-opacity duration-200 hover:opacity-50">Create User</button>
</form>

<!-- JavaScript for Real-time Validation -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // DOM Elements for Validation
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');

        // Email Format Validation Regex
        const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        // Hide name error on focus
        nameInput.addEventListener('focus', () => {
            if (nameError) nameError.style.display = 'none';
            nameInput.classList.remove('border-red-500');
        });

        // Real-time email validation on input
        emailInput.addEventListener('input', () => {
            if (!isValidEmail(emailInput.value)) {
                emailError.style.display = 'block';
                emailError.textContent = 'Please enter a valid email address.';
                emailInput.classList.add('border-red-500');
            } else {
                emailError.style.display = 'none';
                emailInput.classList.remove('border-red-500');
            }
        });

        // Hide email error on focus
        emailInput.addEventListener('focus', () => {
            if (emailError) emailError.style.display = 'none';
            emailInput.classList.remove('border-red-500');
        });
    });
</script>

@endsection
