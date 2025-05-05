<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
                    <path d="M18 2a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h12z"></path>
                    <path d="M9 22v-4h6v4"></path>
                    <path d="M8 10h8"></path>
                    <path d="M8 6h8"></path>
                    <path d="M8 14h8"></path>
                </svg>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">
            Join Our Donor Community
        </h1>
        <p class="mt-2 text-sm text-gray-600">
            Your donation can save up to three lives
        </p>
    </div>

    <!-- Registration Card -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100 mb-8">
        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
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

            <!-- Personal Information Section -->
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-rose-600 font-semibold text-sm uppercase tracking-wider mb-4 flex items-center">
                    Personal Information
                    <span class="ml-3 flex-grow h-px bg-gray-100"></span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-xs font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="Mohammed"
                               required autofocus>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-xs font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="El Alaoui"
                               required>
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label for="birth_date" class="block text-xs font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white"
                               required>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-xs font-medium text-gray-700 mb-1">Gender</label>
                        <select name="gender" id="gender"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white"
                                required>
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Phone (Optional) -->
                    <div>
                        <label for="phone" class="block text-xs font-medium text-gray-700 mb-1">
                            Phone Number <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="06 12 34 56 78">
                    </div>

                    <!-- CNI (ID) (Optional) -->
                    <div>
                        <label for="cni" class="block text-xs font-medium text-gray-700 mb-1">
                            National ID <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <input type="text" name="cni" id="cni" value="{{ old('cni') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="AB123456">
                    </div>
                </div>
            </div>

            <!-- Medical Information Section -->
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-rose-600 font-semibold text-sm uppercase tracking-wider mb-4 flex items-center">
                    Medical Information
                    <span class="ml-3 flex-grow h-px bg-gray-100"></span>
                </h3>

                <!-- Blood Group (Optional) -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-3">
                        Blood Group <span class="text-gray-400 text-xs">(Optional)</span>
                    </label>

                    <!-- Simplified blood type selection -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-4">
                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodType)
                            <div>
                                <input type="radio" id="blood_{{ $bloodType }}" name="blood_group" value="{{ $bloodType }}"
                                       class="sr-only peer" {{ old('blood_group') == $bloodType ? 'checked' : '' }}>
                                <label for="blood_{{ $bloodType }}" class="flex items-center justify-center border border-gray-200 rounded-md text-sm font-medium py-2 cursor-pointer bg-white
                      peer-checked:bg-rose-600 peer-checked:text-white peer-checked:border-rose-600">
                                    {{ $bloodType }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <input type="radio" id="blood_unknown" name="blood_group" value=""
                               class="sr-only peer" {{ old('blood_group') === null || old('blood_group') === '' ? 'checked' : '' }}>
                        <label for="blood_unknown" class="block w-full py-2 px-2 text-center border border-gray-200 rounded-md text-sm font-medium cursor-pointer bg-white mt-2
                  peer-checked:bg-rose-600 peer-checked:text-white peer-checked:border-rose-600">
                            I don't know my blood group
                        </label>
                    </div>

                </div>
            </div>

            <!-- Account Information Section -->
            <div class="p-6 border-b border-gray-100 last:border-b-0">
                <h3 class="text-rose-600 font-semibold text-sm uppercase tracking-wider mb-4 flex items-center">
                    Account Information
                    <span class="ml-3 flex-grow h-px bg-gray-100"></span>
                </h3>

                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                               placeholder="mohammed.elalaoui@gmail.com"
                               required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password" id="password"
                                   class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                                   placeholder="••••••••"
                                   required>
                            <p class="mt-1 text-xs text-gray-400">Minimum 8 characters</p>
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 focus:bg-white placeholder-gray-400"
                                   placeholder="••••••••"
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="bg-gray-50 p-6 border-t border-gray-100">
                <button type="submit" class="bg-rose-600 text-white rounded-lg py-3 px-4 font-medium transition-all duration-200 w-full text-center border-0 cursor-pointer hover:bg-rose-700 hover:-translate-y-1 hover:shadow-md">
                    Create Account
                </button>

                <!-- Login Link -->
                <div class="text-gray-600 text-sm text-center mt-4">
                    Already have an account?
                    <a href="{{route('login')}}" class="text-rose-600 font-medium hover:underline">
                        Sign in
                    </a>
                </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>
