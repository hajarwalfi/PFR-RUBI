<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>
<body class="min-h-screen py-8 px-4">
<div class="max-w-lg mx-auto">
    <!-- Logo and Header -->
    <div class="bg-white rounded-3xl shadow-xs overflow-hidden border border-gray-100 mb-6 p-6 text-center">
        <div class="bg-rose-600 h-2"></div>
        <div class="flex justify-center mt-4">
            <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">
            Welcome Back
        </h1>
        <p class="mt-2 text-sm text-gray-600">
            Sign in to access your donor account
        </p>
    </div>

    <!-- Login Card -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100 mb-8">
        <!-- Form -->
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            @if ($errors->any())
                <div class="p-6 border-b border-gray-100">
                    <div class="bg-red-50 border-l-4 border-rose-600 p-4 rounded-md mb-6 flex">
                        <div class="flex-shrink-0 mr-3">
                            <svg class="w-5 h-5 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">
                                There were {{ $errors->count() }} errors with your submission
                            </h3>
                            <ul class="list-disc pl-5 mt-2 text-xs text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Login Information Section -->
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-rose-600 font-semibold text-sm uppercase tracking-wider mb-4 flex items-center">
                    Account Login
                    <span class="ml-3 flex-grow h-px bg-gray-100"></span>
                </h3>

                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="mohammed.elalaoui@gmail.com"
                               required autofocus>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-xs font-medium text-gray-700">Password</label>
                            <!-- Comment out the forgot password link for now -->
                            <!-- <a href="#" class="text-xs text-rose-600 hover:underline">
                                Forgot password?
                            </a> -->
                        </div>
                        <input type="password" name="password" id="password"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="••••••••"
                               required>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="bg-gray-50 p-6 border-t border-gray-100">
                <button type="submit" class="bg-rose-600 text-white rounded-lg py-3 px-4 font-medium transition-all duration-200 w-full text-center border-0 cursor-pointer hover:bg-rose-700 hover:-translate-y-1 hover:shadow-md">
                    Sign In
                </button>

                <!-- Register Link -->
                <div class="text-gray-600 text-sm text-center mt-4">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-rose-600 font-medium hover:underline">
                        Register now
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
