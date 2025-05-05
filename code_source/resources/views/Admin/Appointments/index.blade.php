@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Upcoming Donations')

@section('content')
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Upcoming Donations</h1>
            <p class="text-sm text-gray-500">Overview of scheduled blood donations in the RUBI application</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Appointments -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Total Appointments</h2>
                    <div class="text-gray-500">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="text-2xl font-bold">{{ $appointmentsByDate->flatten()->count() }}</div>
                <p class="text-xs text-gray-500">All scheduled donations</p>
            </div>

            <!-- Today's Appointments -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Today</h2>
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                        {{ $appointmentsByDate->has(now()->format('Y-m-d')) ? $appointmentsByDate[now()->format('Y-m-d')]->count() : 0 }}
                    </span>
                </div>
                <div class="text-2xl font-bold">
                    {{ $appointmentsByDate->has(now()->format('Y-m-d')) ? $appointmentsByDate[now()->format('Y-m-d')]->count() : 0 }}
                </div>
                <p class="text-xs text-gray-500">Donations scheduled for today</p>
            </div>

            <!-- This Week -->
            @php
                $thisWeekCount = $appointmentsByDate
                    ->filter(function($appointments, $date) {
                        return \Carbon\Carbon::parse($date)->isCurrentWeek();
                    })
                    ->flatten()
                    ->count();
            @endphp
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">This Week</h2>
                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                        {{ $thisWeekCount }}
                    </span>
                </div>
                <div class="text-2xl font-bold">{{ $thisWeekCount }}</div>
                <p class="text-xs text-gray-500">Donations this week</p>
            </div>

            <!-- Next Week -->
            @php
                $nextWeekCount = $appointmentsByDate
                    ->filter(function($appointments, $date) {
                        $appointmentDate = \Carbon\Carbon::parse($date);
                        $nextWeekStart = now()->addWeek()->startOfWeek();
                        $nextWeekEnd = now()->addWeek()->endOfWeek();
                        return $appointmentDate->between($nextWeekStart, $nextWeekEnd);
                    })
                    ->flatten()
                    ->count();
            @endphp
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Next Week</h2>
                    <span class="inline-flex items-center rounded-full bg-purple-50 px-2.5 py-0.5 text-xs font-semibold text-purple-700">
                        {{ $nextWeekCount }}
                    </span>
                </div>
                <div class="text-2xl font-bold">{{ $nextWeekCount }}</div>
                <p class="text-xs text-gray-500">Upcoming next week</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg border border-gray-200 mb-6">
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold">Donation Schedule</h2>
                        <p class="text-sm text-gray-500">View and manage upcoming blood donation appointments</p>
                    </div>
                </div>
            </div>

            <!-- Appointments List -->
            <div class="divide-y divide-gray-200">
                @forelse($appointmentsByDate as $date => $dailyAppointments)
                    <div class="p-4">
                        <h3 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-calendar-day mr-2 text-gray-400"></i>
                            {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                            <span class="ml-2 bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $dailyAppointments->count() }} donors
                            </span>
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                            @foreach($dailyAppointments as $appointment)
                                <div class="bg-gray-50 p-4 rounded-md border border-gray-200 hover:shadow-md transition-shadow">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-semibold">
                                            {{ strtoupper(substr($appointment->user->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr($appointment->user->last_name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $appointment->user->first_name ?? 'Unknown' }} {{ $appointment->user->last_name ?? 'User' }}
                                            </p>
                                            <div class="flex items-center text-xs text-gray-500">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                            </div>
                                        </div>
                                    </div>

                                    @if($appointment->blood_group)
                                        <div class="mt-3 flex items-center">
                                            <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-semibold text-red-700">
                                                <i class="fas fa-tint mr-1"></i> {{ $appointment->blood_group }}
                                            </span>

                                            @if($appointment->donation_type)
                                                <span class="ml-2 inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                                                    {{ $appointment->donation_type }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-400 mb-4">
                            <i class="fas fa-calendar-times text-2xl"></i>
                        </div>
                        <p class="text-gray-500">No upcoming appointments scheduled.</p>
                        <p class="text-sm text-gray-400 mt-2">Create new appointments to see them here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection
