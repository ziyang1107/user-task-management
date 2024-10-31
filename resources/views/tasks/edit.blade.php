@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
<h1 class="text-2xl font-bold mb-4">Add New Task</h1>

<form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
    @csrf

    <!-- Task Title -->
    <div class="mb-4">
        <label for="title" class="block font-bold">Title</label>
        <input type="text" id="title" name="title" class="border w-full p-2" required>
    </div>

    <!-- Task Description -->
    <div class="mb-4">
        <label for="description" class="block font-bold">Description</label>
        <textarea id="description" name="description" class="border w-full p-2" required></textarea>
    </div>

    <!-- Assigned User Section -->
    <div class="mb-4">
        <label for="user_id" class="block font-bold">Assigned To</label>
        @if($currentUser)
        <!-- Show selected user in read-only format if accessed from User Details page -->
        <p class="border w-full p-2 bg-gray-100">{{ $currentUser->name }}</p>
        <input type="hidden" name="user_id" value="{{ $currentUser->id }}">
        @else
        <!-- Show dropdown if no specific user is selected -->
        <select id="user_id" name="user_id" class="border w-full p-2" required>
            <option value="">Select a user</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @endif
    </div>

    <!-- Task Status -->
    <div class="mb-4">
        <label for="status" class="block font-bold">Status</label>
        <select id="status" name="status" class="border w-full p-2" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>
    </div>

    <!-- Due Date -->
    <div class="mb-4">
        <label for="due_date" class="block font-bold">Due Date</label>
        <input type="date" id="due_date" name="due_date" class="border w-full p-2" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded font-bold">
        Add Task
    </button>
</form>
@endsection
