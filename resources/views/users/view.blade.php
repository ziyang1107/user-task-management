@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">User Details</h1>

<!-- Task Status: Display success message if session contains 'success' -->
@if(session('success'))
<div id="success-message" class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- User Information Section -->
<div class="bg-white shadow rounded-lg p-6 mb-15 mt-6">
    <div class="grid grid-cols-2 gap-5">
        <!-- Basic User Details -->
        <div>
            <p class="mb-1"><strong>User ID:</strong></p>
            <p class="mb-4">{{ $user->id }}</p>

            <p class="mb-1"><strong>Name:</strong></p>
            <p class="mb-4">{{ $user->name }}</p>

            <p class="mb-1"><strong>Email:</strong></p>
            <p class="mb-4">{{ $user->email }}</p>
        </div>
        <!-- User Timestamps -->
        <div>
            <p class="mb-1"><strong>Created At:</strong></p>
            <p class="mb-4">{{ $user->created_at->format('Y-m-d / H:i:s') }}</p>

            <p class="mb-1"><strong>Updated At:</strong></p>
            <p class="mb-4">{{ $user->updated_at->format('Y-m-d / H:i:s') }}</p>
        </div>
    </div>
</div>

<!-- Task Controls Section -->
<div class="flex justify-between items-center mt-10 mb-6">
    <!-- Add New Task Button -->
    <a href="{{ route('tasks.create', ['user_id' => $user->id]) }}"
       class="bg-green-500 text-white font-semibold px-4 py-2 rounded inline-block transition-opacity duration-200 hover:opacity-50"
       aria-label="Add new task for user">
        Add New Task
    </a>
    <!-- Total Task Count -->
    <span class="text-gray-600 font-semibold">Total Tasks: {{ $user->tasks->count() }}</span>
</div>

<!-- Associated Tasks Section -->
<div class="bg-white shadow-lg rounded-lg p-6 min-h-[500px] mb-15 mt-6">
    <h2 class="text-lg font-semibold mb-4">Associated Tasks</h2>

    @if($user->tasks->isEmpty())
    <!-- Message for No Tasks -->
    <p class="text-gray-500">No tasks assigned to this user</p>
    @else
    <!-- Scrollable Table Container for Task List -->
    <div class="overflow-y-auto max-h-64">
        <table class="table-auto w-full border border-gray-700 mt-4" aria-label="User tasks table">
            <thead>
            <tr style="background-color: #BCD2E8;">
                <!-- Table Headers for Task Details -->
                <th class="border px-4 py-2 text-center">ID</th>
                <th class="border px-4 py-2 text-center">Title</th>
                <th class="border px-4 py-2 text-center">Description</th>
                <th class="border px-4 py-2 text-center">Status</th>
                <th class="border px-4 py-2 text-center">Due Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->tasks as $task)
            <tr>
                <!-- Task Information in Each Row -->
                <td class="border px-4 py-2 text-center">{{ $task->id }}</td>
                <td class="border px-4 py-2 text-center">{{ $task->title }}</td>
                <td class="border px-4 py-2 text-center">{{ $task->description ?: 'N/A' }}</td>
                <td class="border px-4 py-2 text-center">
                    <span class="{{ $task->status == 'completed' ? 'text-green-500' : 'text-yellow-500' }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </td>
                <td class="border px-4 py-2 text-center">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<!-- JavaScript to Auto-hide Success Message -->
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
