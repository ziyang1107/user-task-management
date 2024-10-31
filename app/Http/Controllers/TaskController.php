<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $request->session()->put('previous_url', url()->full());

        $tasks = Task::with('user')->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request): View
    {
        $userId = $request->query('user_id');

        $users = User::all();

        $currentUser = $userId ? User::find($userId) : null;

        return view('tasks.create', compact('currentUser', 'users'));
    }

    /**
     * Store a newly created task in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the input data.
        $validated = $request->validate([
            'title' => 'required|string|min:3',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create($validated);

        $previousUrl = $request->session()->get('previous_url', route('tasks.index'));

        $request->session()->forget('previous_url');

        return redirect($previousUrl)->with('success', 'Task created successfully!');
    }

    /**
     * Display a specific task.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\View\View
     */
    public function show(Task $task, Request $request): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing a specific task.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task): View
    {
        $users = User::all();

        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * Update a specific task in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        // Validate the updated input data.
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    /**
     * Delete a specific task from the database.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
