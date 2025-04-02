<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'RUBI Admin')</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    <style>
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            z-index: 10;
        }
        .dropdown.show {
            display: block;
        }
    </style>
</head>

<body class="bg-white">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 border-r border-gray-200 bg-white">
        <div class="p-6 font-bold text-xl">RUBI Admin</div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        @yield('content')
    </main>

</div>
</body>

</html>
