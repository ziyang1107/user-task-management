@extends('layouts.app')

@section('title', 'Task List')

@section('content')

<!-- Page Header -->
<h1 class="text-2xl font-bold mb-4">Task List</h1>

<!-- Success Message: Displays confirmation if session contains a 'success' message -->
@if(session('success'))
<div id="success-message" class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<!-- Add New Task Button -->
<a href="{{ route('tasks.create') }}" class="bg-green-500 text-white font-semibold px-4 py-2 rounded inline-block transition-opacity duration-200 hover:opacity-50">Add New Task</a>

<!-- Total Task Count Display -->
<div class="flex justify-end mb-4">
    <span class="text-gray-600 font-semibold">Total Tasks: {{ $tasks->count() }}</span>
</div>

@if($tasks->isEmpty())
<!-- Display Message if No Tasks are Available -->
<div class="flex items-center justify-center h-64">
    <p class="text-gray-500 text-center text-2xl font-bold">No tasks available...</p>
</div>
@else
<!-- Scrollable Table Container -->
<div class="overflow-x-auto">
    <table class="table-auto w-full mt-4 border border-gray-700">
        <thead>
        <tr class="bg-gray-200">
            <!-- Table Headers for Task Details -->
            <th class="border px-2 py-2" style="width: 5%;">ID</th>
            <th class="border px-4 py-2">Title</th>
            <th class="border px-4 py-2" style="width: 30%;">Description</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Due Date</th>
            <th class="border px-4 py-2">Assigned User</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
        <tr>
            <!-- Task Information in Each Row -->
            <td class="border px-2 py-2 text-center" style="width: 5%;">{{ $task->id }}</td>
            <td class="border px-4 py-2 text-center">{{ $task->title }}</td>
            <td class="border px-4 py-2 text-center" style="width: 30%;">{{ $task->description ?? 'N/A' }}</td>
            <td class="border px-4 py-2 text-center">
                <!-- Task Status with Conditional Styling -->
                <span class="{{ $task->status == 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ ucfirst($task->status) }}
                </span>
            </td>
            <td class="border px-4 py-2 text-center">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
            <td class="border px-4 py-2 text-center">{{ $task->user->name ?? 'Unassigned' }}</td>
            <td class="border px-4 py-2 text-center">
                <!-- Edit Task Button -->
                <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-2 py-2 rounded font-bold text-sm inline-block text-center w-20 mr-2 transition-opacity duration-200 hover:opacity-50" title="Edit Task">Edit</a>

                <!-- Delete Task Form with Confirmation Prompt -->
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete {{ $task->title }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded font-bold text-sm inline-block text-center w-20 transition-opacity duration-200 hover:opacity-50" title="Delete Task">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif

<script>
    // Function for Delete Confirmation Prompt
    function confirmDelete() {
        return confirm('Are you sure you want to delete this task?');
    }

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
