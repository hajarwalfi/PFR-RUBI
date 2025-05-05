@extends('User.layouts.aside')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="mb-8">
                <h1 class="font-serif text-3xl mb-2 text-red-800">My Appointments</h1>
                <p class="text-gray-600 text-sm">View and manage your blood donation appointments</p>
            </div>

            <div class="flex justify-end mb-8">
                <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Schedule Appointment
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-md shadow-sm" role="alert">
                    <p class="font-medium">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(count($appointments) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($appointments as $appointment)
                        <div class="p-6 rounded-lg border border-red-100 hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-2xl font-serif mb-1 text-red-800">
                                        {{ $appointment->date->format('d M') }}
                                    </div>
                                    <div class="text-xs uppercase tracking-wider text-red-600">
                                        {{ $appointment->date->format('l, Y') }}
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        {{ date('h:i A', strtotime($appointment->time)) }}
                                    </div>
                                    @if(isset($appointment->location))
                                        <div class="mt-2 text-xs text-gray-500">
                                            {{ $appointment->location }}
                                        </div>
                                    @endif
                                </div>
                                <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center">
                                    <i class="fas fa-calendar-day text-red-500 text-lg"></i>
                                </div>
                            </div>

                            @if(isset($appointment->donation_type))
                                <div class="mt-3 pt-3 border-t border-red-50">
                                    <div class="flex items-center">
                                        <i class="fas fa-tint text-red-500 mr-2 text-xs"></i>
                                        <span class="text-xs text-gray-600">{{ $appointment->donation_type ?? 'Whole Blood' }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @if(method_exists($appointments, 'links'))
                    <div class="mt-8 flex justify-center">
                        {{ $appointments->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16 bg-red-50 rounded-lg border border-red-100">
                    <i class="fas fa-calendar-alt text-red-300 text-4xl"></i>
                    <h3 class="mt-4 text-lg font-medium text-red-800">No appointments found</h3>
                    <p class="mt-2 text-sm text-red-600">You haven't scheduled any blood donation appointments yet.</p>
                    <div class="mt-6">
                        <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700">
                            Schedule an Appointment
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
