<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        .active-tab {
            background-color: #BCD2E8;
            border-radius: 0.375rem;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <nav class="mb-10 flex justify-between items-center">
        <!-- Navigation Links -->
        <div class="flex space-x-4">
            <a href="{{ route('welcome') }}"
               class="text-lg px-3 py-2 {{ request()->routeIs('welcome') ? 'text-blue-700 font-bold active-tab' : 'text-blue-500' }}">
                Home
            </a>

            <a href="{{ route('users.index') }}"
               class="text-lg px-3 py-2 {{ request()->routeIs('users.*') ? 'text-blue-700 font-bold active-tab' : 'text-blue-500' }}">
                Users
            </a>

            <a href="{{ route('tasks.index') }}"
               class="text-lg px-3 py-2 {{ request()->routeIs('tasks.*') ? 'text-blue-700 font-bold active-tab' : 'text-blue-500' }}">
                Tasks
            </a>
        </div>

        <!-- Back Button -->
        <a href="{{ url()->previous() }}"
           class="text-lg text-gray-600 hover:text-gray-800 font-semibold flex items-center">
            <!-- Optional Back Icon -->
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
    </nav>

    <!-- Page Content -->
    @yield('content')
</div>

</body>
</html>
