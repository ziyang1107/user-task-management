<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        .underline-offset {
            text-decoration: underline;
            text-underline-offset: 6px;
            text-decoration-thickness: 3px;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <nav class="mb-6 flex justify-between items-center">
        <div>
            <a href="{{ route('users.index') }}"
               class="mr-4 text-lg {{ request()->routeIs('users.*') ? 'text-blue-700 underline-offset font-bold' : 'text-blue-500' }}">
                Users
            </a>

            <a href="{{ route('tasks.index') }}"
               class="text-lg {{ request()->routeIs('tasks.*') ? 'text-blue-700 underline-offset font-bold' : 'text-blue-500' }}">
                Tasks
            </a>
        </div>

        <a href="{{ url()->previous() }}"
           class="text-lg text-gray-600 hover:text-gray-800 font-semibold">
            Back
        </a>
    </nav>

    @yield('content')
</div>

</body>
</html>
