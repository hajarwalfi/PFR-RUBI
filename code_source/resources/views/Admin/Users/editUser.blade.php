@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Edit Donor Profile')

@section('content')

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-xs">
            <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                <i class="fas fa-arrow-left h-2 w-4"></i>
            </a>
            <div class="flex items-center text-gray-500">
                <a href="{{ route('admin.users.index') }}" class="hover:text-black hover:underline">Donors</a>
                <span class="mx-2">&gt;</span>
                <a href="{{ route('admin.users.show', $user->id) }}" class="hover:text-black hover:underline">{{ $user->first_name }} {{ $user->last_name }}</a>
                <span class="mx-2">&gt;</span>
                <span class="hover:text-black">Edit Profile</span>
            </div>
        </div>

        <!-- Main Form Container -->
        <div class="bg-white rounded-md p-6 mt-6">
            <!-- Page Title -->
            <h1 class="text-2xl font-bold mb-1">Edit Donor Profile</h1>
            <p class="text-sm text-gray-600 mb-6">Update the donor's personal and medical information</p>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Donor Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">Donor Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-user h-4 w-4 text-gray-500 mr-1"></i>
                                Last Name
                            </label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="Enter donor's last name" class="w-full px-3 py-2 border @error('last_name') border-red-500 @else border-gray-300 @enderror rounded-md">
                            @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-user h-4 w-4 text-gray-500 mr-1"></i>
                                First Name
                            </label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="Enter donor's first name" class="w-full px-3 py-2 border @error('first_name') border-red-500 @else border-gray-300 @enderror rounded-md">
                            @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-birthday-cake h-4 w-4 text-gray-500 mr-1"></i>
                                Birth Date
                            </label>
                            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}" class="w-full px-3 py-2 border @error('birth_date') border-red-500 @else border-gray-300 @enderror rounded-md">
                            @error('birth_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Identity Card (CNI) -->
                        <div>
                            <label for="cni" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-id-card h-4 w-4 text-gray-500 mr-1"></i>
                                Identity Card
                            </label>
                            <input type="text" id="cni" name="cni" value="{{ old('cni', $user->cni) }}" placeholder="e.g. AB123456" class="w-full px-3 py-2 border @error('cni') border-red-500 @else border-gray-300 @enderror rounded-md">
                            @error('cni')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-phone h-4 w-4 text-gray-500 mr-1"></i>
                                Phone
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="e.g. 06XXXXXXXX" class="w-full px-3 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-md">
                            @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-envelope h-4 w-4 text-gray-500 mr-1"></i>
                                Email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="example@email.com" class="w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md">
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt h-4 w-4 text-gray-500 mr-1"></i>
                            Address
                        </label>
                        <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" placeholder="123 Street, City, 1234" class="w-full px-3 py-2 border @error('address') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Blood Group -->
                    <div class="mt-6">
                        <label for="blood_group" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tint h-4 w-4 text-gray-500 mr-1"></i>
                            Blood Group
                        </label>
                        <div class="relative">
                            <select id="blood_group" name="blood_group" class="w-full px-3 py-2 border @error('blood_group') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="">Select a blood group</option>
                                <option value="A+" {{ old('blood_group', $user->blood_group) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group', $user->blood_group) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group', $user->blood_group) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group', $user->blood_group) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_group', $user->blood_group) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group', $user->blood_group) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_group', $user->blood_group) == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group', $user->blood_group) == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i class="fas fa-chevron-down h-4 w-4 text-gray-400"></i>
                            </div>
                        </div>
                        @error('blood_group')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.users.show', $user->id) }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-save h-5 w-5 mr-2"></i>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
