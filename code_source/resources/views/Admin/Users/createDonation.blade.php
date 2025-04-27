@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Add Donation')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-xs">
            <a href="{{ route('admin.users.show', $user->id ?? 0) }}" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                <i class="fas fa-arrow-left h-2 w-4"></i>
            </a>
            <div class="flex items-center text-gray-500">
                <a href="{{ route('admin.users.index') }}" class="hover:text-black hover:underline">Donors</a>
                <span class="mx-2">&gt;</span>
                <a href="{{ route('admin.users.show', $user->id ?? 0) }}" class="hover:text-black hover:underline">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</a>
                <span class="mx-2">&gt;</span>
                <span class="hover:text-black">Add Donation</span>
            </div>
        </div>

        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-1">Add New Donation</h1>
        <p class="text-sm text-gray-600 mb-6">Enter blood donation information</p>

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

        <form action="{{ route('admin.donations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">

            <!-- Donation Information Section -->
            <div class="bg-white rounded-md border border-gray-200 p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Donation Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Donation Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tag h-4 w-4 text-gray-500 mr-1"></i>
                            Donation Type
                        </label>
                        <select id="type" name="type" class="w-full px-3 py-2 border @error('type') border-red-500 @else border-gray-300 @enderror rounded-md">
                            <option value="Voluntary" {{ old('type') == 'Voluntary' ? 'selected' : '' }}>Voluntary</option>
                            <option value="Compensated" {{ old('type') == 'Compensated' ? 'selected' : '' }}>Compensated</option>
                        </select>
                        @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Donation Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="far fa-calendar-alt h-4 w-4 text-gray-500 mr-1"></i>
                            Donation Date
                        </label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}" class="w-full px-3 py-2 border @error('date') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Donation Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt h-4 w-4 text-gray-500 mr-1"></i>
                            Location
                        </label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Transfusion center, hospital, etc." class="w-full px-3 py-2 border @error('location') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity Collected -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-tint h-4 w-4 text-gray-500 mr-1"></i>
                            Quantity (ml)
                        </label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" class="w-full px-3 py-2 border @error('quantity') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('quantity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Operator -->
                    <div>
                        <label for="operator" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user-md h-4 w-4 text-gray-500 mr-1"></i>
                            Operator
                        </label>
                        <input type="text" id="operator" name="operator" value="{{ old('operator') }}" placeholder="Doctor or nurse name..." class="w-full px-3 py-2 border @error('operator') border-red-500 @else border-gray-300 @enderror rounded-md">
                        @error('operator')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Serology Information Section -->
            <div class="bg-white rounded-md border border-gray-200 p-6">
                <h2 class="text-lg font-semibold mb-4">Serology Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- TPHA -->
                    <div>
                        <label for="serology_tpha" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-vial h-4 w-4 text-gray-500 mr-1"></i>
                            TPHA
                        </label>
                        <div class="relative">
                            <select id="serology_tpha" name="serology[tpha]" class="w-full px-3 py-2 border @error('serology.tpha') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="negative" {{ old('serology.tpha') == 'negative' ? 'selected' : '' }}>Negative</option>
                                <option value="positive" {{ old('serology.tpha') == 'positive' ? 'selected' : '' }}>Positive</option>
                                <option value="pending" {{ old('serology.tpha', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i class="fas fa-chevron-down h-4 w-4 text-gray-400"></i>
                            </div>
                        </div>
                        @error('serology.tpha')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HB -->
                    <div>
                        <label for="serology_hb" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-vial h-4 w-4 text-gray-500 mr-1"></i>
                            HB
                        </label>
                        <div class="relative">
                            <select id="serology_hb" name="serology[hb]" class="w-full px-3 py-2 border @error('serology.hb') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="negative" {{ old('serology.hb') == 'negative' ? 'selected' : '' }}>Negative</option>
                                <option value="positive" {{ old('serology.hb') == 'positive' ? 'selected' : '' }}>Positive</option>
                                <option value="pending" {{ old('serology.hb', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i class="fas fa-chevron-down h-4 w-4 text-gray-400"></i>
                            </div>
                        </div>
                        @error('serology.hb')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HC -->
                    <div>
                        <label for="serology_hc" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-vial h-4 w-4 text-gray-500 mr-1"></i>
                            HC
                        </label>
                        <div class="relative">
                            <select id="serology_hc" name="serology[hc]" class="w-full px-3 py-2 border @error('serology.hc') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="negative" {{ old('serology.hc') == 'negative' ? 'selected' : '' }}>Negative</option>
                                <option value="positive" {{ old('serology.hc') == 'positive' ? 'selected' : '' }}>Positive</option>
                                <option value="pending" {{ old('serology.hc', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i class="fas fa-chevron-down h-4 w-4 text-gray-400"></i>
                            </div>
                        </div>
                        @error('serology.hc')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- HIV -->
                    <div>
                        <label for="serology_vih" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-vial h-4 w-4 text-gray-500 mr-1"></i>
                            HIV
                        </label>
                        <div class="relative">
                            <select id="serology_vih" name="serology[vih]" class="w-full px-3 py-2 border @error('serology.vih') border-red-500 @else border-gray-300 @enderror rounded-md appearance-none pr-10">
                                <option value="negative" {{ old('serology.vih') == 'negative' ? 'selected' : '' }}>Negative</option>
                                <option value="positive" {{ old('serology.vih') == 'positive' ? 'selected' : '' }}>Positive</option>
                                <option value="pending" {{ old('serology.vih', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                <i class="fas fa-chevron-down h-4 w-4 text-gray-400"></i>
                            </div>
                        </div>
                        @error('serology.vih')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('admin.users.show', $user->id ?? 0) }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-save h-5 w-5 mr-2"></i>
                        Save
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection
