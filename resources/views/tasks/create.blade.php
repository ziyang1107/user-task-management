@extends('layouts.app')

@section('title', 'Create Task')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">Create Task</h1>

<!-- Task Creation Form -->
<form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf
    <!-- Store the previous URL in a hidden input -->
    <input type="hidden" name="previous_url" value="{{ url()->previous() }}">

    <!-- User Assignment Section with Search Functionality -->
    @if(request()->query('user_id'))
    <!-- If user_id is in query, assign it directly as a hidden input -->
    <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}">
    @else
    <div class="mb-4 relative">
        <!-- User Search Input -->
        <label for="user_search" class="block font-bold">Assign to User</label>
        <input
            type="text"
            id="user_search"
            onkeyup="filterUsers()"
            placeholder="Username*"
            class="border w-full p-2 mt-2 {{ $errors->has('user_id') ? 'border-red-500' : '' }}"
        >

        <!-- User Dropdown (hidden, updated via JavaScript) -->
        <select
            id="user_dropdown"
            name="user_id"
            class="w-full hidden {{ $errors->has('user_id') ? 'border-red-500' : '' }}"
        >
            <option value="">Select a user</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
            </option>
            @endforeach
        </select>

        <!-- Filtered User Results Display -->
        <div id="user_results" class="absolute w-full bg-gray-200 shadow-md max-h-40 overflow-y-auto hidden" style="top: calc(100% + 4px); z-index: 10;"></div>

        <!-- Error Message Display -->
        @error('user_id')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>
    @endif

    <!-- Task Title Input -->
    <div class="mb-4">
        <label for="title" class="block font-bold">Title</label>
        <input type="text" id="title" name="title" placeholder="Title*" class="border w-full p-2 mt-2 {{ $errors->has('title') ? 'border-red-500' : '' }}" ">
        @error('title') <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span> @enderror
    </div>

    <!-- Task Description Textarea -->
    <div class="mb-4">
        <label for="description" class="block font-bold">Description</label>
        <textarea id="description" name="description" placeholder="Description*" class="border w-full p-2 mt-2" rows="5">{{ old('description') }}</textarea>
        @error('description') <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span> @enderror
    </div>

    <!-- Task Status Dropdown -->
    <div class="mb-4">
        <label for="status" class="block font-bold">Status</label>
        <select id="status" name="status" class="border w-full p-2 mt-2 h-10">
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        @error('status') <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span> @enderror
    </div>

    <!-- Task Due Date Input -->
    <div class="mb-4">
        <label for="due_date" class="block font-bold">Due Date</label>
        <input type="date" id="due_date" name="due_date" class="border w-full p-2 mt-2" value="{{ old('due_date') }}">
        @error('due_date') <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span> @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Create Task</button>
</form>

<script>
    // Filter Users based on search input
    function filterUsers() {
        const input = document.getElementById('user_search').value.toLowerCase();
        const resultsDiv = document.getElementById('user_results');
        const options = document.getElementById('user_dropdown').getElementsByTagName('option');

        // Clear previous results
        resultsDiv.innerHTML = '';

        // Filter options and create clickable list
        let hasResults = false;
        for (let i = 1; i < options.length; i++) {
            const option = options[i];
            const text = option.text.toLowerCase();

            if (text.includes(input)) {
                const resultItem = document.createElement('div');
                resultItem.textContent = option.text;
                resultItem.className = 'p-2 cursor-pointer hover:bg-gray-300';
                resultItem.onclick = () => {
                    document.getElementById('user_search').value = option.text;
                    document.getElementById('user_dropdown').value = option.value;
                    resultsDiv.classList.add('hidden');
                };
                resultsDiv.appendChild(resultItem);
                hasResults = true;
            }
        }

        // Show or hide results based on matching users
        resultsDiv.classList.toggle('hidden', !hasResults);
    }

    // Hide results when clicking outside of search or results area
    document.addEventListener('click', function(event) {
        const resultsDiv = document.getElementById('user_results');
        if (!document.getElementById('user_search').contains(event.target) && !resultsDiv.contains(event.target)) {
            resultsDiv.classList.add('hidden');
        }
    });

    // Set minimum date for the due date input to today
    document.addEventListener('DOMContentLoaded', function() {
        const dueDateInput = document.getElementById('due_date');
        const today = new Date().toISOString().split('T')[0];
        dueDateInput.setAttribute('min', today);
    });

    // Hide error messages on focus for both title and user search inputs
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = ['title', 'user_search'];

        inputs.forEach(inputId => {
            const inputElement = document.getElementById(inputId);

            if (inputElement) {
                inputElement.addEventListener('focus', () => {
                    const errorSpan = inputElement.parentElement.querySelector('.text-red-500');
                    if (errorSpan) {
                        errorSpan.style.display = 'none';
                    }

                    inputElement.classList.remove('border-red-500');
                });
            }
        });
    });
</script>

@endsection
