@extends('User.layouts.aside')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto max-w-4xl">
            <div class="mb-10">
                <h1 class="font-serif text-3xl mb-2 text-red-800 font-light">My Profile</h1>
                <div class="w-16 h-0.5 bg-red-200"></div>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-2 border-green-400 text-green-700 p-4 mb-6" role="alert">
                    <p class="text-sm font-light">{!! session('success') !!}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-2 border-red-400 text-red-700 p-4 mb-6" role="alert">
                    <p class="text-sm font-light">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-lg border border-gray-100 overflow-hidden mb-10">
                <!-- Profile Header -->
                <div class="bg-red-50 px-8 py-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center text-white text-2xl font-light">
                                {{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name ?? 'U', 0, 1)) }}
                            </div>
                        </div>
                        <div class="ml-8">
                            <h2 class="text-2xl font-light text-gray-800">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                            <p class="text-gray-500 text-sm mt-1">{{ auth()->user()->email }}</p>
                            <p class="text-gray-400 text-xs mt-2">Member since {{ auth()->user()->created_at->format('F Y') }}</p>

                            @if(auth()->user()->blood_group)
                                <div class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-light bg-red-50 text-red-600 border border-red-100">
                                    <i class="fas fa-tint mr-1.5 text-red-500"></i> {{ auth()->user()->blood_group }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="mb-12">
                <h2 class="text-xl font-light text-gray-800 mb-6 flex items-center">
                    <span class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-red-400 text-sm"></i>
                    </span>
                    Personal Information
                </h2>

                <form action="{{ route('dashboard.profile.update-personal') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label for="first_name" class="block text-sm text-gray-500 mb-1.5">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}"
                                   class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                            @error('first_name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm text-gray-500 mb-1.5">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}"
                                   class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                            @error('last_name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm text-gray-500 mb-1.5">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="{{ auth()->user()->phone }}"
                                   class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                            @error('phone')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm text-gray-500 mb-1.5">Date of Birth</label>
                            <input type="date" name="birth_date" id="birth_date"
                                   value="{{ auth()->user()->birth_date ? auth()->user()->birth_date->format('Y-m-d') : '' }}"
                                   class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                            @error('birth_date')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="blood_group" class="block text-sm text-gray-500 mb-1.5">Blood Type</label>
                            <select name="blood_group" id="blood_group"
                                    class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                                <option value="">Select Blood Type</option>
                                <option value="A+" {{ auth()->user()->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ auth()->user()->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ auth()->user()->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ auth()->user()->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ auth()->user()->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ auth()->user()->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ auth()->user()->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ auth()->user()->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            @error('blood_group')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block text-sm text-gray-500 mb-1.5">Gender</label>
                            <select name="gender" id="gender"
                                    class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                                <option value="">Select Gender</option>
                                <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ auth()->user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="cni" class="block text-sm text-gray-500 mb-1.5">CNI (National ID)</label>
                        <input type="text" name="cni" id="cni" value="{{ auth()->user()->cni }}"
                               class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                        @error('cni')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm text-gray-500 mb-1.5">Address</label>
                        <textarea name="address" id="address" rows="2"
                                  class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800 resize-none">{{ auth()->user()->address }}</textarea>
                        @error('address')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-white border border-red-300 text-red-600 text-sm font-medium rounded-md hover:bg-red-50 transition-colors">
                            Save Information
                        </button>
                    </div>
                </form>
            </div>

            <!-- Account Settings Section -->
            <div class="mb-12">
                <h2 class="text-xl font-light text-gray-800 mb-6 flex items-center">
                    <span class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-envelope text-red-400 text-sm"></i>
                    </span>
                    Account Settings
                </h2>

                <form action="{{ route('dashboard.profile.update-account') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="email" class="block text-sm text-gray-500 mb-1.5">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                               class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                        @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-white border border-red-300 text-red-600 text-sm font-medium rounded-md hover:bg-red-50 transition-colors">
                            Update Email
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password Section -->
            <div class="mb-12">
                <h2 class="text-xl font-light text-gray-800 mb-6 flex items-center">
                    <span class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center mr-3">
                        <i class="fas fa-lock text-red-400 text-sm"></i>
                    </span>
                    Change Password
                </h2>

                <form action="{{ route('dashboard.profile.update-password') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm text-gray-500 mb-1.5">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                               class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                        @error('current_password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm text-gray-500 mb-1.5">New Password</label>
                        <input type="password" name="password" id="password"
                               class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                        @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm text-gray-500 mb-1.5">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full px-0 py-2 bg-transparent border-0 border-b border-gray-200 focus:ring-0 focus:border-red-300 text-gray-800">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-white border border-red-300 text-red-600 text-sm font-medium rounded-md hover:bg-red-50 transition-colors">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
