@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Task</h1>

<form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf

    @if(request()->query('user_id'))
    <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}">
    @else
    <div class="mb-4 relative">
        <label for="user_search" class="block font-bold">Assign to User</label>
        <input type="text" id="user_search" onkeyup="filterUsers()" placeholder="Search user by name" class="border w-full p-2 mb-2">

        <!-- Hidden dropdown for form submission -->
        <select id="user_dropdown" name="user_id" class="hidden">
            <option value="">Select a user</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
            </option>
            @endforeach
        </select>

        <!-- Display filtered results here -->
        <div id="user_results" class="absolute w-full bg-gray-200 rounded shadow-md max-h-40 overflow-y-auto hidden" style="top: calc(100% + 4px); z-index: 10;"></div>

        @error('user_id') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    @endif

    <div class="mb-4">
        <label for="title" class="block font-bold">Title</label>
        <input type="text" id="title" name="title" class="border w-full p-2" value="{{ old('title') }}">
        @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block font-bold">Description</label>
        <textarea id="description" name="description" class="border w-full p-2">{{ old('description') }}</textarea>
        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="block font-bold">Status</label>
        <select id="status" name="status" class="border w-full p-2">
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label for="due_date" class="block font-bold">Due Date</label>
        <input type="date" id="due_date" name="due_date" class="border w-full p-2" value="{{ old('due_date') }}">
        @error('due_date') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Task</button>
</form>

<script>
    function filterUsers() {
        const input = document.getElementById('user_search').value.toLowerCase();
        const resultsDiv = document.getElementById('user_results');
        const options = document.getElementById('user_dropdown').getElementsByTagName('option');

        // Clear previous results
        resultsDiv.innerHTML = '';

        // Filter options and create clickable list
        let hasResults = false;
        for (let i = 1; i < options.length; i++) { // Start from 1 to skip "Select a user" option
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

    // Hide results when clicking outside
    document.addEventListener('click', function(event) {
        const resultsDiv = document.getElementById('user_results');
        if (!document.getElementById('user_search').contains(event.target) && !resultsDiv.contains(event.target)) {
            resultsDiv.classList.add('hidden');
        }
    });
</script>
@endsection
