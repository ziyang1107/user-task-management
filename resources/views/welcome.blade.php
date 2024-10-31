<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Task Management App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-6">Welcome to the User Task Management</h1>

        <div class="space-x-4 mt-12">
            <a href="{{ route('users.index') }}"
               class="bg-blue-500 text-white px-6 py-4 text-lg rounded hover:bg-blue-600 mr-6 ">
                Manage Users
            </a>
            <a href="{{ route('tasks.index') }}"
               class="bg-green-500 text-white px-6 py-4 text-lg rounded hover:bg-green-600 ml-6">
                Manage Tasks
            </a>
        </div>
    </div>
</div>

</body>
</html>
