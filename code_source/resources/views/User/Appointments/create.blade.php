@extends('User.layouts.Template')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 max-w-4xl py-12">
            <div class="mb-10">
                <div class="flex items-center">
                    <a href="{{ route('dashboard.appointments') }}" class="text-red-600 hover:text-red-800 mr-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="font-serif text-3xl text-red-800 font-light">Schedule Appointment</h1>
                </div>
                <div class="w-16 h-0.5 bg-red-200 mt-2"></div>
            </div>

            @if(session('error'))
                <div class="bg-red-50 border-l-2 border-red-400 text-red-700 p-4 mb-6" role="alert">
                    <p class="text-sm font-light">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-lg border border-gray-100 overflow-hidden mb-10">
                <div class="p-6">
                    <form action="{{ route('appointments.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <label for="date" class="block text-sm text-gray-500 mb-1.5">Select Day</label>
                                <select name="date" id="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500" required>
                                    <option value="">Select a day</option>
                                    @foreach($availableDays as $day)
                                        <option value="{{ $day['value'] }}">{{ $day['label'] }}</option>
                                    @endforeach
                                </select>
                                @error('date')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="time" class="block text-sm text-gray-500 mb-1.5">Select Time</label>
                                <select name="time" id="time"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500" required>
                                    <option value="">Select a time</option>
                                    @foreach($availableTimes as $time)
                                        <option value="{{ $time['value'] }}">{{ $time['label'] }}</option>
                                    @endforeach
                                </select>
                                @error('time')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="px-6 py-2.5 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
                                Schedule Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
