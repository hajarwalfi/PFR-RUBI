@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Medical Record')

@section('content')
    <main class="flex-1">
        <div class="flex-1">
            <!-- Navigation -->
            <div class="p-4 flex justify-between items-center border-b border-gray-200">
                <div class="flex items-center space-x-2 text-xs">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                        <i class="fas fa-arrow-left h-5 w-5"></i>
                    </a>
                    <div class="flex items-center text-gray-500">
                        <a href="{{ route('admin.users.index') }}" class="hover:text-black hover:underline">Donors</a>
                        <span class="mx-2">&gt;</span>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="hover:text-black hover:underline">{{ $user->first_name }} {{ $user->last_name }}</a>
                    </div>
                </div>

                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-black text-white px-4 py-2 rounded-md flex items-center space-x-2">
                    <i class="fas fa-edit h-5 w-5"></i>
                    <span>Edit Profile</span>
                </a>
            </div>

            <!-- Donor Information -->
            <div class="p-6">
                <!-- Name and status -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-1">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <i class="far fa-calendar-alt h-5 w-5 text-gray-500 mr-1"></i>
                            <span class="text-gray-600">{{ $user->identifier ?? 'N/A' }}</span>
                        </div>
                        @php
                            $status = $userService->determineUserStatus($user);
                        @endphp
                        <span class="{{ $status['class'] }} px-3 py-1 rounded-full text-sm">{{ $status['status'] }}</span>
                    </div>
                </div>

                <!-- Information sections with custom grid -->
                <div class="grid grid-cols-12 gap-6">
                    <!-- Personal Information -->
                    <div class="col-span-12 md:col-span-4 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Section title -->
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <i class="fas fa-user h-5 w-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">Personal Information</h3>
                                <p class="text-xs text-gray-500">Contact details and donor information</p>
                            </div>
                        </div>

                        <!-- Blood group -->
                        <div class="p-4 border-b border-gray-200 flex">
                            <div class="flex items-center justify-center w-16 h-16">
                                <div class="text-red-500">
                                    <i class="fas fa-tint h-8 w-8"></i>
                                </div>
                            </div>
                            <div class="flex-1 flex justify-between items-center">
                                <div class="text-xl font-bold">{{ $user->blood_group ?? 'N/A' }}</div>
                                @php
                                    $isEligible = $userService->isUserEligible($user);
                                @endphp
                                <div class="text-{{ $isEligible ? 'green' : 'red' }}-600 font-medium">
                                    {{ $isEligible ? 'Eligible' : 'Ineligible' }}
                                </div>
                            </div>
                        </div>

                        <!-- Identity Card -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-id-card h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Identity Card</span>
                            </div>
                            <p class="font-medium text-sm pl-7">{{ $user->cni ?? 'Not provided' }}</p>
                        </div>

                        <!-- Birth Date -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-birthday-cake h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Birth Date</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $user->birth_date ? $user->birth_date->format('m/d/Y') : 'Not provided' }}</p>
                        </div>

                        <!-- Phone -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-phone h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Phone</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $user->phone ?? 'Not provided' }}</p>
                        </div>

                        <!-- Email -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-envelope h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Email</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $user->email }}</p>
                        </div>

                        <!-- Address -->
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-map-marker-alt h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Address</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $user->address ?? 'Not provided' }}</p>
                        </div>
                    </div>

                    <!-- Donation History -->
                    <div class="col-span-12 md:col-span-8 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Section title -->
                        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <i class="fas fa-history h-5 w-5"></i>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold">Donation History</h3>
                                    <p class="text-xs text-gray-500">Blood donation history</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.donations.create', ['user_id' => $user->id]) }}" class="bg-black text-white px-3 py-2 rounded-md flex items-center text-sm">
                                <i class="fas fa-plus h-5 w-5 mr-1"></i>
                                Add Donation
                            </a>
                        </div>

                        <!-- Donations table -->
                        <div>
                            <table class="min-w-full divide-y divide-gray-200 rounded-md">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Serology</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($user->donations as $donation)
                                    <tr>
                                        <td class="px-6 py-4 text-xs text-left text-gray-900">{{ $donation->identifier }}</td>
                                        <td class="px-6 py-4 text-xs text-left text-gray-500">{{ $donation->date->format('m/d/Y') }}</td>
                                        <td class="px-6 py-4 text-xs text-left text-gray-500">{{ $donation->type }}</td>
                                        <td class="px-6 py-4">
                                            @if($donation->serology)
                                                <span class="flex items-center text-xs {{ $donation->serology->result === 'positive' ? 'text-red-600' : 'text-green-600' }}">
                                                    @if($donation->serology->result === 'positive')
                                                        <i class="fas fa-times-circle h-5 w-5 mr-1"></i>
                                                    @else
                                                        <i class="fas fa-check-circle h-5 w-5 mr-1"></i>
                                                    @endif
                                                    {{ $donation->serology->result === 'positive' ? 'Positive' : 'Negative' }}
                                                </span>
                                            @else
                                                <span class="flex items-center text-xs text-gray-500">
                                                    <i class="fas fa-clock h-5 w-5 mr-1"></i>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm font-medium">
                                            <div class="relative">
                                                <button class="text-gray-400 hover:text-gray-700 action-btn" onclick="toggleDonationDropdown(this)">
                                                    <i class="fas fa-ellipsis-h h-5 w-5"></i>
                                                </button>
                                                <div class="donation-dropdown hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-10">
                                                    <div class="py-1">
                                                        <a href="{{ route('admin.donations.show', $donation->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="far fa-eye mr-2"></i> View details
                                                        </a>
                                                        <a href="{{ route('admin.donations.edit', $donation->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="far fa-edit mr-2"></i> Edit
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No donations recorded for this donor.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 10;
        }

        .dropdown.show {
            display: block;
        }
    </style>

    <script>
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.action-btn') && !event.target.closest('.dropdown')) {
                const dropdowns = document.querySelectorAll('.dropdown');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }

            if (!event.target.closest('.action-btn') && !event.target.closest('.donation-dropdown')) {
                const dropdowns = document.querySelectorAll('.donation-dropdown');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });

        function toggleDropdown(button) {
            const allDropdowns = document.querySelectorAll('.dropdown');
            allDropdowns.forEach(dropdown => {
                if (dropdown !== button.nextElementSibling) {
                    dropdown.classList.remove('show');
                }
            });

            const dropdown = button.nextElementSibling;
            dropdown.classList.toggle('show');

            event.stopPropagation();
        }

        function toggleDonationDropdown(button) {
            const allDropdowns = document.querySelectorAll('.donation-dropdown');
            allDropdowns.forEach(dropdown => {
                if (dropdown !== button.nextElementSibling) {
                    dropdown.classList.add('hidden');
                }
            });

            const dropdown = button.nextElementSibling;
            dropdown.classList.toggle('hidden');

            event.stopPropagation();
        }
    </script>
@endsection
