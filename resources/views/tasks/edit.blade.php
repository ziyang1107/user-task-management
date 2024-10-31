@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">Edit Task</h1>

<!-- Edit Task Form -->
<form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf
    @method('PUT')

    <!-- User Selection with Search and Dropdown -->
    <div class="mb-4 relative">
        @if(request()->query('user_id'))
        <!-- Hidden input to set user ID if passed as a query parameter -->
        <input type="hidden" name="user_id" value="{{ request()->query('user_id') }}">
        @else
        <!-- User Search Field with Dynamic Dropdown -->
        <label for="user_search" class="block font-bold">Assign to User</label>
        <input type="text" id="user_search" onkeyup="filterUsers()"
               placeholder="Username*"
               class="border w-full p-2 mt-2"
               value="{{ old('user_id') ? $users->firstWhere('id', old('user_id'))->name : ($task->user ? $task->user->name : '') }}">

        <!-- Dropdown for selected user -->
        <select id="user_dropdown" name="user_id" class="w-full hidden">
            <option value="">Select a user</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}"
                    {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
            </option>
            @endforeach
        </select>

        <!-- Filtered Results for User Search -->
        <div id="user_results"
             class="absolute w-full bg-gray-200 shadow-md max-h-40 overflow-y-auto hidden"
             style="top: calc(100% + 4px); z-index: 10;">
        </div>
        @error('user_id')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
        @endif
    </div>

    <!-- Title Input Field -->
    <div class="mb-4">
        <label for="title" class="block font-bold">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}"
               placeholder="Task Title*"
               class="border w-full p-2 mt-2 {{ $errors->has('title') ? 'border-red-500' : '' }}">
        @error('title')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Description Textarea Field -->
    <div class="mb-4">
        <label for="description" class="block font-bold">Description</label>
        <textarea id="description" name="description" placeholder="Task Description"
                  class="border w-full p-2 mt-2" rows="5" {{ $errors->has('description') ? 'border-red-500' : '' }}">{{ old('description', $task->description) }}</textarea>
        @error('description')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Status Selection Dropdown -->
    <div class="mb-4">
        <label for="status" class="block font-bold">Status</label>
        <select id="status" name="status" class="border w-full p-2 mt-2 h-10">
            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in-progress" {{ old('status', $task->status) == 'in-progress' ? 'selected' : '' }}>In Progress</option>
            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
        @error('status')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Due Date Field -->
    <div class="mb-4">
        <label for="due_date" class="block font-bold">Due Date</label>
        <input type="date" id="due_date" name="due_date" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"
               class="border w-full p-2 mt-2 {{ $errors->has('due_date') ? 'border-red-500' : '' }}">
        @error('due_date')
        <span class="text-red-500 text-sm mt-1 block font-bold">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded mt-3">Save Changes</button>
</form>

<!-- JavaScript for Success Message and User Search Functionality -->
<script>
    // JavaScript Variables and Functions for User Search and Selection
    let users = @json($users);

    function filterUsers() {
        const query = document.getElementById("user_search").value.toLowerCase();
        const resultsContainer = document.getElementById("user_results");
        resultsContainer.innerHTML = '';  // Clear previous results

        if (query) {
            const filteredUsers = users.filter(user => user.name.toLowerCase().includes(query));
            if (filteredUsers.length > 0) {
                filteredUsers.forEach(user => {
                    const div = document.createElement("div");
                    div.className = "p-2 cursor-pointer hover:bg-gray-300";
                    div.textContent = user.name;
                    div.onclick = () => selectUser(user.id, user.name);
                    resultsContainer.appendChild(div);
                });
                resultsContainer.classList.remove("hidden");
            } else {
                resultsContainer.classList.add("hidden");
            }
        } else {
            resultsContainer.classList.add("hidden");
        }
    }

    // Select user from search results and populate hidden input
    function selectUser(userId, userName) {
        document.getElementById("user_search").value = userName;
        document.getElementById("user_dropdown").value = userId;
        document.getElementById("user_results").classList.add("hidden");
    }
</script>

@endsection
