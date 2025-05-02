<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RUBI - Dashboard')</title>
    @vite('resources/css/user.css')
    @vite('resources/js/user.js')
</head>

<body class="font-sans">
<div class="flex min-h-screen">
    <aside class="bg-white h-full fixed left-0 top-0 w-[250px] lg:w-[250px] shadow-md flex flex-col z-20 " id="sideMenu">
        <div class="border-b border-red-100 py-4">
            <div class="flex justify-center items-center">
                <a href="" class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-md">
                        <i class="ri-drop-fill text-white text-lg"></i>
                    </div>
                    <h1 class="text-lg font-bold ml-2.5 text-gray-800">RUBI</h1>
                </a>
            </div>
        </div>

        <div class="flex-1 flex flex-col justify-center">
            <nav class="px-4">
                <div class="mb-5">
                    <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 px-1">Medical Record</div>
                    <ul>
                        <li>
                            <a href="{{route('dashboard.donations')}}" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-red-50">
                                <i class="ri-heart-pulse-line text-lg mr-3 text-gray-500"></i>
                                <span>My Donations</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-5">
                    <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 px-1">Community</div>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard.myPosts')}}" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-red-50 {{ request()->routeIs('user.community.my-posts') ? 'bg-red-50 font-medium' : 'text-gray-700' }}">
                                <i class="ri-file-paper-2-line text-lg mr-3 {{ request()->routeIs('dashboard.myPosts') ? 'text-red-600' : 'text-gray-500' }}"></i>
                                <span>My Posts</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.myComments')}}" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-red-50 {{ request()->routeIs('user.community.my-comments') ? 'bg-red-50 font-medium' : 'text-gray-700' }}">
                                <i class="ri-chat-1-line text-lg mr-3 {{ request()->routeIs('dashboard.myComments') ? 'text-red-600' : 'text-gray-500' }}"></i>
                                <span>My Comments</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <div class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-2 px-1">Personal Information</div>
                    <ul>
                        <li>
                            <a href="" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-red-50 {{ request()->routeIs('user.profile.*') ? 'bg-red-50 font-medium' : 'text-gray-700' }}">
                                <i class="ri-user-line text-lg mr-3 {{ request()->routeIs('user.profile.*') ? 'text-red-600' : 'text-gray-500' }}"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="border-t border-red-100 px-4 py-4">
            <ul class="space-y-2.5">
                <li>
                    <a href="" class="flex items-center px-3 py-2 text-sm rounded-md hover:bg-red-50 {{ request()->routeIs('user.settings') ? 'bg-red-50 font-medium' : 'text-gray-700' }}">
                        <i class="ri-settings-3-line text-lg mr-3 {{ request()->routeIs('user.settings') ? 'text-red-600' : 'text-gray-500' }}"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center px-3 py-2 text-sm w-full text-left rounded-md bg-red-600 text-white hover:bg-red-700 transition-colors">
                            <i class="ri-logout-box-r-line text-lg mr-3 text-white"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <button id="closeSideMenu" class="lg:hidden absolute top-3 right-3 text-gray-500 hover:text-gray-700 bg-white rounded-full w-7 h-7 flex items-center justify-center shadow-md">
            <i class="ri-close-line text-xl"></i>
        </button>
    </aside>


    <div id="openSideMenu" class=" z-30 lg:hidden bg-white p-2 rounded-full shadow-lg text-gray-700 w-10 h-10 flex items-center justify-center cursor-pointer">
        <i class="ri-menu-line text-xl"></i>
    </div>


    <main class="flex-1 lg:ml-[250px] pt-4">
        @yield('content')
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        const sideMenu = document.getElementById('sideMenu');
        const openBtn = document.getElementById('openSideMenu');
        const closeBtn = document.getElementById('closeSideMenu');

        openBtn.addEventListener('click', function() {
            sideMenu.style.display = 'flex';
        });

        closeBtn.addEventListener('click', function() {
            sideMenu.style.display = 'none';
        });
    });
</script>
</body>
</html>
