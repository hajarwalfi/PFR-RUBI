<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RUBI Admin - Donneurs</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-white font-Geist ">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 border-r border-gray-200 bg-white">
        <div class="p-6 font-bold text-xl">RUBI Admin</div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">

    </main>
</div>
</body>
</html>
