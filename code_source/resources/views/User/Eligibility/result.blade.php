@extends('User.layouts.Template')

@section('title') RUBI - Eligibility Results @endsection

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 py-12 max-w-6xl">
            <div class="max-w-3xl mx-auto">

                <div class="text-center mb-8">
                    <div class="uppercase text-gray-500 text-xs tracking-widest mb-2 font-medium">Eligibility Results</div>
                    <h1 class="font-serif text-2xl mb-3 leading-tight">Your Blood Donation Eligibility</h1>
                    <p class="text-gray-600 text-sm">Based on the information you provided</p>
                </div>


                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-8">

                    @if($isEligible)
                        <div class="bg-green-50 p-6 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-100 rounded-full p-2">
                                    <i class="ri-checkbox-circle-line text-green-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-serif text-xl text-green-800">You appear to be eligible to donate blood</h2>
                                    <p class="text-green-700 mt-1 text-sm">Based on your responses, you meet the basic requirements for blood donation.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-red-50 p-6 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-red-100 rounded-full p-2">
                                    <i class="ri-close-circle-line text-red-600 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-serif text-xl text-red-800">You may not be eligible to donate blood at this time</h2>
                                    <p class="text-red-700 mt-1 text-sm">{{ $reason }}</p>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="p-6">
                        @if($isEligible)
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="ri-information-line text-blue-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-blue-700">
                                            Please note that this is only a preliminary check. A medical professional will need to verify your eligibility when you visit the donation center. Some factors that cannot be assessed online may affect your ability to donate.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="font-medium mb-4">Next Steps</h3>
                            <ol class="space-y-4 text-sm">
                                <li class="flex">
                                    <span class="bg-gray-100 rounded-full h-6 w-6 flex items-center justify-center mr-2 flex-shrink-0">1</span>
                                    <span>Schedule an appointment at your nearest donation center</span>
                                </li>
                                <li class="flex">
                                    <span class="bg-gray-100 rounded-full h-6 w-6 flex items-center justify-center mr-2 flex-shrink-0">2</span>
                                    <span>Get a good night's sleep before your donation</span>
                                </li>
                                <li class="flex">
                                    <span class="bg-gray-100 rounded-full h-6 w-6 flex items-center justify-center mr-2 flex-shrink-0">3</span>
                                    <span>Eat a healthy meal and drink plenty of fluids before donating</span>
                                </li>
                                <li class="flex">
                                    <span class="bg-gray-100 rounded-full h-6 w-6 flex items-center justify-center mr-2 flex-shrink-0">4</span>
                                    <span>Bring a valid ID and list of medications you're currently taking</span>
                                </li>
                            </ol>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="ri-alert-line text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Thank you for your interest in blood donation. Your willingness to help others is greatly appreciated. Even though you may not be eligible at this time, there are many other ways you can support the cause.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h3 class="font-medium mb-4">What You Can Do</h3>
                            <ul class="space-y-4 text-sm">
                                <li class="flex">
                                    <i class="ri-information-line text-gray-500 mr-2 mt-1"></i>
                                    <span>Consult with a healthcare professional about your specific situation</span>
                                </li>
                                <li class="flex">
                                    <i class="ri-information-line text-gray-500 mr-2 mt-1"></i>
                                    <span>Check back later if your ineligibility is temporary</span>
                                </li>
                                <li class="flex">
                                    <i class="ri-information-line text-gray-500 mr-2 mt-1"></i>
                                    <span>Consider other ways to support blood donation efforts, such as volunteering or organizing drives</span>
                                </li>
                                <li class="flex">
                                    <i class="ri-book-open-line text-gray-500 mr-2 mt-1"></i>
                                    <span>Educate yourself about blood donation by reading our articles</span>
                                </li>
                                <li class="flex">
                                    <i class="ri-team-line text-gray-500 mr-2 mt-1"></i>
                                    <span>Join our community to connect with donors and volunteers</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="bg-gray-50 rounded-lg p-5 mb-8">
                    <h3 class="font-medium text-sm mb-3">Important Information</h3>
                    <p class="text-sm text-gray-600 mb-3">
                        This eligibility check is based on the information you provided and is only a preliminary assessment. Final eligibility will be determined by healthcare professionals at the donation center.
                    </p>
                    <p class="text-sm text-gray-600">
                        If you have any questions or concerns about your eligibility, please contact our donor support team at <span class="text-gray-900">+33 (0)1 23 45 67 89</span>.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('user.eligibility.form') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Take the Test Again
                    </a>
                    @if($isEligible)
                        <a href="#" class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Schedule a Donation
                        </a>
                    @else
                        <a href="" class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            Read Our Articles
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
