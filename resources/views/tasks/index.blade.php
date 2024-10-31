@extends('layouts.app')

@section('title', 'Task List')

@section('content')
<h1 class="text-2xl font-bold mb-4">Task List</h1>

<a href="{{ route('tasks.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-3 inline-block">Add New Task</a>

<div class="flex justify-end mb-4">
    <span class="text-black-600 font-semibold">Total Tasks: {{ $tasks->count() }}</span>
</div>

<table class="table-auto w-full mt-4 border border-gray-700">
    <thead>
    <tr class="bg-gray-200">
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
        <td class="border px-2 py-2 text-center" style="width: 5%;">{{ $task->id }}</td>
        <td class="border px-4 py-2 text-center">{{ $task->title }}</td>
        <td class="border px-4 py-2 text-center" style="width: 30%;">{{ $task->description ?? 'N/A' }}</td>
        <td class="border px-4 py-2 text-center">
            <span class="{{ $task->status == 'completed' ? 'text-green-500' : 'text-yellow-500' }}">
                {{ ucfirst($task->status) }}
            </span>
        </td>
        <td class="border px-4 py-2 text-center">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
        <td class="border px-4 py-2 text-center">{{ $task->user->name ?? 'Unassigned' }}</td>
        <td class="border px-4 py-2 text-center">
            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-2 py-2 rounded font-bold text-sm inline-block text-center w-20 mr-2">Edit</a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded font-bold text-sm inline-block text-center w-20 mr-2">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
