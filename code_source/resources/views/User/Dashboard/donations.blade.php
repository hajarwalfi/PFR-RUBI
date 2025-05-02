@extends('User.layouts.aside')

@section('title') My donations @endsection

@section('content')
    <div class="container mx-auto px-6 ">
        <div class="mb-12">
            <h1 class="font-serif text-3xl mb-2 text-red-800">My Donations</h1>
            <p class="text-gray-600 text-sm">Track your donation history and view your serological results</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class=" p-6 rounded-lg border border-red-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-serif mb-1 text-red-800">{{ $totalDonations }}</div>
                        <div class="text-xs uppercase text-red-600">Total Donations</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-heartbeat text-red-500"></i>
                    </div>
                </div>
            </div>
            <div class=" p-6 rounded-lg border border-red-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-serif mb-1 text-red-800">{{ $totalDonations* 3 }}</div>
                        <div class="text-xs uppercase text-red-600">Lives Saved</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-users text-red-500"></i>
                    </div>
                </div>
            </div>
            <div class=" p-6 rounded-lg border border-red-100">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-3xl font-serif mb-1 text-red-800">{{ $totalDonations * 1000 }}</div>
                        <div class="text-xs uppercase text-red-600">Loyalty Points</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-award text-red-500"></i>
                    </div>
                </div>
            </div>
        </div>

        @if($donations->isEmpty())
            <div class="text-center py-16 bg-red-50 rounded-lg border border-red-100">
                <i class="fas fa-tint text-red-300 text-4xl"></i>
                <h3 class="mt-4 text-lg font-medium text-red-800">No donations found</h3>
                <p class="mt-1 text-sm text-red-600">You haven't made any donations yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($donations as $donation)
                    <div class="bg-white rounded-lg shadow-sm ">
                        <!-- Donation Header -->
                        <div class="p-4 bg-red-50 rounded-t-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-tint text-red-500 mr-2"></i>
                                    <h3 class="font-medium text-red-800">{{ $donation->identifier }}</h3>
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 mt-1 ml-3">
                                {{ $donation->date->format('d/m/Y') }} at {{ $donation->location }}
                            </div>
                        </div>

                        <div class="p-3">
                            @if($donation->serology)
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <!-- TPHA Test -->
                                    <div class="flex items-center p-1.5">
                                        <div class="w-6 h-6 rounded-full bg-red-50 flex items-center justify-center mr-2">
                                            <i class="fas fa-bacteria text-red-400 text-xs"></i>
                                        </div>
                                        <span class="text-gray-700">TPHA</span>
                                    </div>
                                    <div class="flex items-center justify-end p-1.5">
                                        @if($donation->serology->tpha == 'positive')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1 text-xs"></i>
                                                Positive
                                            </span>
                                        @elseif($donation->serology->tpha == 'negative')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Negative
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center p-1.5">
                                        <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center mr-2">
                                            <i class="fas fa-shield-virus text-blue-400 text-xs"></i>
                                        </div>
                                        <span class="text-gray-700">Hep B</span>
                                    </div>
                                    <div class="flex items-center justify-end p-1.5">
                                        @if($donation->serology->hb == 'positive')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1 text-xs"></i>
                                                Positive
                                            </span>
                                        @elseif($donation->serology->hb == 'negative')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Negative
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center p-1.5">
                                        <div class="w-6 h-6 rounded-full bg-indigo-50 flex items-center justify-center mr-2">
                                            <i class="fas fa-virus text-indigo-400 text-xs"></i>
                                        </div>
                                        <span class="text-gray-700">Hep C</span>
                                    </div>
                                    <div class="flex items-center justify-end p-1.5">
                                        @if($donation->serology->hc == 'positive')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1 text-xs"></i>
                                                Positive
                                            </span>
                                        @elseif($donation->serology->hc == 'negative')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Negative
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center p-1.5">
                                        <div class="w-6 h-6 rounded-full bg-purple-50 flex items-center justify-center mr-2">
                                            <i class="fas fa-viruses text-purple-400 text-xs"></i>
                                        </div>
                                        <span class="text-gray-700">HIV</span>
                                    </div>
                                    <div class="flex items-center justify-end p-1.5">
                                        @if($donation->serology->vih == 'positive')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1 text-xs"></i>
                                                Positive
                                            </span>
                                        @elseif($donation->serology->vih == 'negative')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Negative
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="p-4 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-file-medical-alt text-gray-300 text-xl mb-2"></i>
                                        <p class="text-xs text-gray-500">No serological information available.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                {{ $donations->links() }}
            </div>
        @endif
    </div>
@endsection
