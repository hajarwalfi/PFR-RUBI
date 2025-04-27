@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Donors')


@section('content')
    <div class ="p-8">
        <h1 class="text-3xl font-bold ">Donors</h1>
        <p class="text-l font-regular text-gray-500 ">Manage blood donors registered in the RUBI application</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-8 mb-8">
        <!-- Total Donors -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Total Donors</h2>
                <div class="p-2 rounded-full">
                    <i class="fas fa-user text-gray-600"></i>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">{{ $statistics['total'] }}</div>
            <div class="text-gray-500 text-xs ">All registered donors</div>
        </div>

        <!-- Eligible Donors -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Eligible Donors</h2>
                <div class="px-2 py-0.5 rounded-full bg-green-100">
                    <span class="text-green-600 font-semibold">{{ $statistics['eligible'] }}</span>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">{{ $statistics['eligible_percent'] }} %</div>
            <div class="text-gray-500 text-xs ">Ready for blood donation</div>
        </div>

        <!-- Ineligible Donors -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Ineligible</h2>
                <div class="px-2 py-0.5 rounded-full bg-red-100">
                    <span class="text-red-600 font-semibold">{{ $statistics['ineligible'] }}</span>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">{{ $statistics['ineligible_percent'] }} %</div>
            <div class="text-gray-500 text-xs ">Temporarily excluded</div>
        </div>

        <!-- Unconfirmed (Empty CNI) -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Unconfirmed</h2>
                <div class="px-2 py-0.5 rounded-full bg-amber-100">
                    <span class="text-amber-600 font-semibold">{{ $statistics['unconfirmed'] }}</span>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">{{ $statistics['unconfirmed'] }}</div>
            <div class="text-gray-500 text-xs ">Without ID number</div>
        </div>
    </div>

    <!-- Donor Management Section -->
    <div class="bg-white rounded-lg border border-gray-200 mx-8 mb-8">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold mb-1">Donor Management</h2>
            <p class="text-gray-500 text-sm">View and manage blood donors registered in the RUBI application</p>
        </div>

        <!-- Search and Filters -->
        <div class="p-4 border-b bg-gray-50 border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-auto">
                <div class="relative w-full bg-white md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for a donor..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full md:w-80 text-sm">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </form>
            <div class="flex gap-2">
                <a href="{{ route('admin.users.index', ['eligibility' => 'eligible']) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm {{ request('eligibility') === 'eligible' ? 'bg-blue-50 border-blue-300' : '' }}">Eligible</a>
                <a href="{{ route('admin.users.index', ['eligibility' => 'ineligible']) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm {{ request('eligibility') === 'ineligible' ? 'bg-blue-50 border-blue-300' : '' }}">Ineligible</a>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                <tr class="text-left border-b border-gray-200">
                    <th class="px-6 py-3 font-medium text-gray-600">First & Last Name</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Blood Group</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Phone</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Eligibility</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    @php
                        $status = $userService->determineUserStatus($user);
                        $isEligible = $userService->isUserEligible($user);
                        $nextDonationDate = $userService->getNextDonationDate($user);
                        $isConfirmed = $userService->isUserConfirmed($user);
                    @endphp
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td class="px-6 text-center py-4">{{ $user->blood_group ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 {{ $status['class'] }} rounded-full text-xs">{{ $status['status'] }}</span>
                        </td>
                        <td class="px-6 py-4">{{ $user->phone ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 {{ $isEligible ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }} rounded-full text-xs">
                                {{ $isEligible ? 'Eligible' : 'Ineligible' }}
                            </span>
                        </td>
                        <td class="px-6 text-center py-4 relative">
                            <button class="text-gray-500 hover:text-gray-700 action-btn" onclick="toggleDropdown(this)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                <div class="py-1">
                                    <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="far fa-file-alt mr-2"></i> View record
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this donor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left">
                                            <i class="far fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No donors found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 flex justify-end items-center border-t border-gray-200">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
    <script>
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.action-btn') && !event.target.closest('.dropdown')) {
                const dropdowns = document.querySelectorAll('.dropdown');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
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
    </script>
@endsection
