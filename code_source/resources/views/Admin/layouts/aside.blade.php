<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RUBI Admin')</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="flex h-screen ">
<!-- Sidebar -->
<div class="w-64 border-r border-gray-700 bg-black shadow-md flex flex-col">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-800">
        <div class="flex items-center">
            <span class="font-bold text-xl text-white">RUBI Admin</span>
        </div>
    </div>

    <!-- Navigation Section -->
    <div class="flex-grow overflow-y-auto bg-black">

        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
            Management
        </div>

        <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white group transition-all duration-200">
            <i class="fas fa-users w-5 h-5 mr-3 text-gray-400 group-hover:text-white"></i>
            <span>Users</span>
        </a>

        <a href="{{ route('admin.posts.moderation') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white group transition-all duration-200">
            <i class="fas fa-comments w-5 h-5 mr-3 text-gray-400 group-hover:text-white"></i>
            <span>Posts</span>
        </a>

        <a href="{{ route('admin.articles.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white group transition-all duration-200">
            <i class="fas fa-newspaper w-5 h-5 mr-3 text-gray-400 group-hover:text-white"></i>
            <span>Articles</span>
        </a>

        <a href="{{ route('admin.appointments.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-800 hover:text-white group transition-all duration-200">
            <i class="fas fa-calendar-check w-5 h-5 mr-3 text-gray-400 group-hover:text-white"></i>
            <span>Appointments</span>
        </a>
    </div>

    <!-- Logout Section - Fixed at Bottom -->
    <div class="border-t space-y-4 border-gray-800 p-4 mt-auto bg-black">
        <a href="{{ route('dashboard.donations') }}" class="flex w-full items-center px-4 py-2 bg-gray-800 text-white rounded-lg shadow-sm hover:bg-gray-700 transition-all duration-200">
            <i class="fas fa-tachometer-alt w-5 h-5 mr-3 text-gray-300"></i>
            <span>Donor Dashboard</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center justify-center py-2 px-4 bg-black border border-gray-700 rounded-lg text-gray-300 hover:bg-gray-800 hover:border-gray-600 transition-all duration-200 shadow-sm">
                <i class="fas fa-sign-out-alt w-5 h-5 mr-2"></i>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<main class="flex-1 overflow-auto ">
    @yield('content')
</main>

</body>

</html>
