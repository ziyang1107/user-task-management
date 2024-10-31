<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a paginated listing of users along with their tasks.
     *
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $users = User::with('tasks')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        // Return the user creation form view.
        return view('users.create');
    }

    /**
     * Store a newly created user in the database.
     * - Name: required, min 3 characters, max 255.
     * - Email: required, must be unique and valid, max 255 characters.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data.
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email|max:255',
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the details of a specific user along with their tasks.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user, Request $request): View
    {
        $request->session()->put('previous_url', url()->full());

        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing an existing user.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     * - Name: required, min 3 characters.
     * - Email: required, must be unique, excluding the current user.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Delete the specified user from the database.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        $maxId = DB::table('users')->max('id') ?? 0;
        DB::statement('ALTER TABLE users AUTO_INCREMENT = ' . ($maxId + 1));

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
