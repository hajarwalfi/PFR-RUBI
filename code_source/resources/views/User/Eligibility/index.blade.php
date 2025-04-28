@extends('User.layouts.Template')

@section('title') RUBI - Check My Eligibility @endsection

@section('content')
    <div class="bg-white min-h-screen bg-pattern">
        <div class="container mx-auto px-6 py-12 max-w-6xl">
            <div class="text-center mb-12">
                <h1 class="font-serif text-3xl md:text-4xl mb-3 text-gray-900">Blood Donation Eligibility</h1>
                <div class="w-20 h-1 bg-red-500 mx-auto mb-6 rounded-full"></div>
                <p class="max-w-2xl mx-auto text-gray-600 text-sm md:text-base">
                    Your generosity can save lives. Complete this quick assessment to check if you're eligible to donate blood today.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-5">
                    <div class="mb-6 relative rounded-xl overflow-hidden shadow-lg">
                        <div class="bg-gradient-to-r from-red-600 to-red-700 p-6 text-white">
                            <div class="inline-block px-3 py-1 bg-white/90 rounded-full text-xs font-semibold tracking-wider text-red-600 uppercase mb-3">
                                About This Test
                            </div>
                            <h2 class="text-white text-xl font-serif mb-4 drop-shadow-sm">
                                Why This Test Matters
                            </h2>
                            <p class="text-white/90 text-sm leading-relaxed mb-2">
                                This preliminary test allows you to assess whether you meet the general conditions for donating blood. It does not replace a medical interview but can help you determine if you should visit a donation center.
                            </p>
                            <p class="text-white/90 text-sm leading-relaxed">
                                Completing this assessment will give you immediate feedback on your eligibility status based on common donation criteria.
                            </p>
                        </div>
                    </div>

                    <h2 class="font-serif text-2xl mb-4 leading-tight text-gray-900">
                        Why Your Donation Matters
                    </h2>

                    <p class="text-gray-600 mb-5 text-sm leading-relaxed">
                        Blood donation is a life-saving act of kindness. Before you donate, it's important to ensure you meet the basic requirements. This quick eligibility check will help you determine if you can donate blood today.
                    </p>

                    <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl shadow-sm border border-gray-100 mt-6">
                        <h3 class="font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                            Benefits of Donating Blood
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-red-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 text-sm text-gray-600">One donation can save up to three lives</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-red-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 text-sm text-gray-600">Blood is needed every two seconds</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-red-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 text-sm text-gray-600">Regular donation provides a free mini health check-up</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0 h-6 w-6 rounded-full bg-red-100 flex items-center justify-center mt-0.5">
                                    <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 text-sm text-gray-600">Helps reduce the risk of heart disease and cancer</p>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 bg-red-50 p-5 rounded-xl border border-red-100 relative">
                        <svg class="absolute top-3 left-3 w-8 h-8 text-red-200" fill="currentColor" viewBox="0 0 32 32">
                            <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                        <div class="pl-6 pr-2">
                            <p class="italic text-sm text-gray-700 mb-3">
                                "I've been donating blood for over 10 years now. It's a small act that makes a huge difference. The feeling of knowing you've helped save someone's life is incredible."
                            </p>
                            <p class="text-right text-xs font-medium text-gray-900">— Sarah, Regular Donor</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                            <h2 class="font-serif text-xl text-white">Eligibility Questionnaire</h2>
                            <p class="text-red-100 text-sm mt-1">Please answer all questions accurately</p>
                        </div>

                        <form action="{{ route('user.eligibility.check') }}" method="POST" class="p-6 space-y-6">
                            @csrf
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Age
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="age" value="under18" class="mr-2 text-red-500">
                                        <span class="text-sm">Under 18 years</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="age" value="18to65" class="mr-2 text-red-500">
                                        <span class="text-sm">18-65 years</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="age" value="over65" class="mr-2 text-red-500">
                                        <span class="text-sm">Over 65 years</span>
                                    </label>
                                </div>
                                @error('age')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                    Weight
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="weight" value="under50kg" class="mr-2 text-red-500">
                                        <span class="text-sm">Under 50kg (110 lbs)</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="weight" value="over50kg" class="mr-2 text-red-500">
                                        <span class="text-sm">50kg (110 lbs) or more</span>
                                    </label>
                                </div>
                                @error('weight')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Have you been ill in the past 14 days?
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="recent_illness" value="yes" class="mr-2 text-red-500">
                                        <span class="text-sm">Yes</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="recent_illness" value="no" class="mr-2 text-red-500">
                                        <span class="text-sm">No</span>
                                    </label>
                                </div>
                                @error('recent_illness')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Have you donated blood in the last 8 weeks?
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="previous_donation" value="yes" class="mr-2 text-red-500">
                                        <span class="text-sm">Yes</span>
                                    </label>
                                    <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                        <input type="radio" name="previous_donation" value="no" class="mr-2 text-red-500">
                                        <span class="text-sm">No</span>
                                    </label>
                                </div>
                                @error('previous_donation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Do you have any of the following conditions?
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2 bg-gray-50 p-4 rounded-lg">
                                    <label class="flex items-center p-2 hover:bg-white rounded transition-colors">
                                        <input type="radio" name="medical_condition" value="heart_disease" class="mr-2 text-red-500">
                                        <span class="text-sm">Heart disease</span>
                                    </label>
                                    <label class="flex items-center p-2 hover:bg-white rounded transition-colors">
                                        <input type="radio" name="medical_condition" value="diabetes" class="mr-2 text-red-500">
                                        <span class="text-sm">Diabetes</span>
                                    </label>
                                    <label class="flex items-center p-2 hover:bg-white rounded transition-colors">
                                        <input type="radio" name="medical_condition" value="hepatitis" class="mr-2 text-red-500">
                                        <span class="text-sm">Hepatitis</span>
                                    </label>
                                    <label class="flex items-center p-2 hover:bg-white rounded transition-colors">
                                        <input type="radio" name="medical_condition" value="hiv" class="mr-2 text-red-500">
                                        <span class="text-sm">HIV/AIDS</span>
                                    </label>
                                    <label class="flex items-center p-2 hover:bg-white rounded transition-colors col-span-1 sm:col-span-2">
                                        <input type="radio" name="medical_condition" value="none" class="mr-2 text-red-500">
                                        <span class="text-sm">None of the above</span>
                                    </label>
                                </div>
                                @error('medical_condition')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-md hover:shadow-lg">
                                    Check My Eligibility
                                </button>
                                <p class="text-xs text-gray-500 mt-3 text-center">
                                    This is a preliminary check only. Final eligibility will be determined at the donation center.
                                </p>
                            </div>
                        </form>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 flex">
                            <div class="flex-shrink-0 bg-red-100 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Important Notice</h3>
                                <p class="text-xs text-gray-600 mt-1">
                                    If you've recently traveled to certain countries, you may be temporarily deferred from donating. Please consult with our staff for more information.
                                </p>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 flex">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2 h-10 w-10 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-900">Preparation Tips</h3>
                                <p class="text-xs text-gray-600 mt-1">
                                    Eat a healthy meal and drink plenty of fluids before donating. Bring a valid ID and list of medications you're currently taking.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500 space-y-4 sm:space-y-0">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Contact us: <span class="text-gray-900 font-medium ml-1">+33 (0)1 23 45 67 89</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>123 Blood Donation Street, 75000 Paris</span>
                </div>
            </div>
        </div>
    </div>
@endsection
