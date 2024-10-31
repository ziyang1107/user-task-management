<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Management App</title>

    <!-- Tailwind CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">

<!-- Page Container -->
<div class="flex items-center justify-center h-screen">
    <div class="text-center">
        <!-- Page Header -->
        <h1 class="text-4xl font-bold mb-6">Welcome to the User Task Management</h1>

        <!-- Button Links for Navigation -->
        <div class="space-x-4 mt-12">
            <!-- Manage Users Button -->
            <a href="{{ route('users.index') }}"
               class="bg-blue-500 text-white px-6 py-4 text-lg rounded transition duration-300 ease-in-out hover:bg-blue-600 hover:font-bold mr-6">
                Manage Users
            </a>

            <!-- Manage Tasks Button -->
            <a href="{{ route('tasks.index') }}"
               class="bg-green-500 text-white px-6 py-4 text-lg rounded transition duration-300 ease-in-out hover:bg-green-600 hover:font-bold ml-6">
                Manage Tasks
            </a>
        </div>
    </div>
</div>

</body>
</html>
