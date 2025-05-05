@extends('User.layouts.Template')

@section('content')
    <!-- Enhanced Hero Section with Elegant Typography -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/mommy.jpg') }}" alt="Mother and baby" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/30"></div>
        </div>

        <div class="container mx-auto px-6 py-24 md:py-32 max-w-6xl relative z-10">
            <div class="max-w-xl">
                <h1 class="font-serif text-5xl md:text-6xl font-bold text-white leading-tight mb-6">
                    Give blood, <br><span class="text-red-100">offer life!</span>
                </h1>
                <p class="text-blue-100 text-lg mb-10 leading-relaxed">
                    Every drop of blood you donate
                    is a promise for the future.
                    It allows a child to grow, a mother
                    to hold her baby in her arms, a
                    family to keep hope.
                </p>
                <div class="flex space-x-4">
                    <a href="{{route('register')}}" class="inline-flex items-center justify-center px-8 py-4 bg-red-600 text-white text-base font-medium rounded-md shadow-lg hover:bg-red-700 transition-all duration-300">
                        <i class="fas fa-heart mr-2"></i> Become a Donor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Luxurious Statistics Section -->
    <div class="bg-white py-20">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-12">
                <h2 class="font-serif text-3xl text-gray-900 mb-3">Our Impact</h2>
                <div class="w-24 h-0.5 bg-red-600 mx-auto"></div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Donors Stat -->
                <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-red-50 rounded-full text-red-600 mr-4">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div>
                            <div class="text-4xl font-serif text-red-800 font-medium leading-none">15K<span class="text-red-600 text-xl">+</span></div>
                            <div class="text-xs uppercase tracking-wider text-gray-500 mt-1">Donors</div>
                        </div>
                    </div>
                </div>

                <!-- Lives Saved Stat -->
                <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-red-50 rounded-full text-red-600 mr-4">
                            <i class="fas fa-heartbeat text-xl"></i>
                        </div>
                        <div>
                            <div class="text-4xl font-serif text-red-800 font-medium leading-none">25K<span class="text-red-600 text-xl">+</span></div>
                            <div class="text-xs uppercase tracking-wider text-gray-500 mt-1">Lives Saved</div>
                        </div>
                    </div>
                </div>

                <!-- Donation Centers Stat -->
                <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-red-50 rounded-full text-red-600 mr-4">
                            <i class="fas fa-hospital text-xl"></i>
                        </div>
                        <div>
                            <div class="text-4xl font-serif text-red-800 font-medium leading-none">100<span class="text-red-600 text-xl">+</span></div>
                            <div class="text-xs uppercase tracking-wider text-gray-500 mt-1">Centers</div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Donations Stat -->
                <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-14 h-14 bg-red-50 rounded-full text-red-600 mr-4">
                            <i class="fas fa-tint text-xl"></i>
                        </div>
                        <div>
                            <div class="text-4xl font-serif text-red-800 font-medium leading-none">5K<span class="text-red-600 text-xl">+</span></div>
                            <div class="text-xs uppercase tracking-wider text-gray-500 mt-1">Monthly</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Elegant Latest Articles Section -->
    <div class="bg-red-50 py-16">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <div class="uppercase text-red-600 text-sm tracking-widest mb-2 font-medium">Stay Informed</div>
                    <h2 class="font-serif text-3xl text-gray-900">Latest Articles</h2>
                </div>
                <a href="{{ route('articles.index') }}" class="text-red-700 font-medium flex items-center">
                    <span>View all articles</span>
                    <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>

            @if($articles->isNotEmpty())
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                    <!-- Featured Article -->
                    <div class="rounded-lg overflow-hidden border border-gray-100">
                        @if($articles->first()->picture)
                            <img
                                src="{{ asset('storage/' . $articles->first()->picture) }}"
                                alt="{{ $articles->first()->title }}"
                                class="w-full h-[280px] object-cover"
                            >
                        @else
                            <div class="w-full h-[280px] bg-gray-200"></div>
                        @endif
                        <div class="bg-white p-6">
                            <div class="inline-block bg-red-100 text-red-700 text-xs uppercase tracking-wider px-3 py-1 rounded-md mb-3">Featured</div>
                            <h3 class="font-serif text-xl text-gray-900 mb-3">{{ $articles->first()->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($articles->first()->content), 150) }}
                            </p>
                            <a href="{{ route('articles.show', $articles->first()->id) }}" class="text-red-700 text-sm inline-flex items-center">
                                Read full article
                                <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Article List -->
                    <div class="space-y-6">
                        @foreach($articles->skip(1)->take(3) as $article)
                            <div class="flex space-x-4 items-start bg-white p-5 rounded-lg border border-gray-100">
                                <div class="flex-shrink-0 w-20 h-20 overflow-hidden rounded-md">
                                    @if($article->picture)
                                        <img
                                            src="{{ asset('storage/' . $article->picture) }}"
                                            alt="{{ $article->title }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <div class="w-full h-full bg-gray-200"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-serif text-lg text-gray-900 mb-2 leading-tight">
                                        {{ $article->title }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                                        {{ Str::limit(strip_tags($article->content), 80) }}
                                    </p>
                                    <a href="{{ route('articles.show', $article->id) }}" class="text-red-700 text-sm inline-flex items-center">
                                        Read more
                                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Luxurious Donation Process Section -->
    <div class="bg-white py-20" id="eligibility">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-14">
                <div class="uppercase text-red-600 text-sm tracking-widest mb-2 font-medium">How It Works</div>
                <h2 class="font-serif text-3xl text-gray-900 mb-3">The Donation Process</h2>
                <div class="w-24 h-0.5 bg-red-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Donating blood is a simple and safe process that takes about an hour from start to finish.
                    Here's what you can expect when you donate blood.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full text-red-600 mx-auto mb-5 relative">
                        <i class="fas fa-clipboard-list text-xl"></i>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 rounded-full text-white text-xs flex items-center justify-center font-bold">1</div>
                    </div>
                    <h3 class="font-serif text-lg text-gray-900 mb-3">Registration</h3>
                    <p class="text-gray-600">
                        Sign up online or in person at one of our donation centers.
                    </p>
                    <div class="mt-3 text-xs text-gray-500"><i class="far fa-clock mr-1"></i> 5-10 minutes</div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full text-red-600 mx-auto mb-5 relative">
                        <i class="fas fa-stethoscope text-xl"></i>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 rounded-full text-white text-xs flex items-center justify-center font-bold">2</div>
                    </div>
                    <h3 class="font-serif text-lg text-gray-900 mb-3">Screening</h3>
                    <p class="text-gray-600">
                        Quick health check to ensure you're eligible to donate.
                    </p>
                    <div class="mt-3 text-xs text-gray-500"><i class="far fa-clock mr-1"></i> 10-15 minutes</div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full text-red-600 mx-auto mb-5 relative">
                        <i class="fas fa-tint text-xl"></i>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 rounded-full text-white text-xs flex items-center justify-center font-bold">3</div>
                    </div>
                    <h3 class="font-serif text-lg text-gray-900 mb-3">Donation</h3>
                    <p class="text-gray-600">
                        The actual blood donation takes only about 10 minutes.
                    </p>
                    <div class="mt-3 text-xs text-gray-500"><i class="far fa-clock mr-1"></i> 8-10 minutes</div>
                </div>

                <!-- Step 4 -->
                <div class="bg-white p-7 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full text-red-600 mx-auto mb-5 relative">
                        <i class="fas fa-mug-hot text-xl"></i>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 rounded-full text-white text-xs flex items-center justify-center font-bold">4</div>
                    </div>
                    <h3 class="font-serif text-lg text-gray-900 mb-3">Recovery</h3>
                    <p class="text-gray-600">
                        Enjoy refreshments while resting for 15 minutes before leaving.
                    </p>
                    <div class="mt-3 text-xs text-gray-500"><i class="far fa-clock mr-1"></i> 15 minutes</div>
                </div>
            </div>

            <div class="text-center mt-14">
                <a href="{{route('user.eligibility.form')}}" class="inline-flex items-center justify-center px-8 py-4 bg-red-600 text-white text-base font-medium rounded-lg shadow-md hover:bg-red-700 transition-all duration-300">
                    <i class="fas fa-clipboard-check mr-2"></i> Check My Eligibility
                </a>
            </div>
        </div>
    </div>

    <!-- Refined Hero Rewards Program Section -->
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-12">
                <div class="uppercase text-red-600 text-sm tracking-widest mb-2 font-medium">Recognition Program</div>
                <h2 class="font-serif text-3xl text-gray-900 mb-3">Because Every Hero Deserves Recognition!</h2>
                <div class="w-24 h-0.5 bg-red-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Your generosity doesn't go unnoticed. Join our rewards program and reap the benefits of your commitment!
                </p>
            </div>

            <div class="flex flex-wrap justify-center items-center">
                <!-- Left Side Rewards -->
                <div class="w-full md:w-1/4 flex flex-col items-center mb-8 md:mb-0">
                    <!-- Special Gifts -->
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full text-red-600 mx-auto mb-3 border border-red-200 shadow-sm hover:shadow transition-all duration-300">
                            <i class="fas fa-gift text-2xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 text-sm">Special Gifts</h3>
                    </div>

                    <!-- Loyalty Points -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full text-red-600 mx-auto mb-3 border border-red-200 shadow-sm hover:shadow transition-all duration-300">
                            <i class="fas fa-star text-2xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 text-sm">Loyalty Points</h3>
                    </div>
                </div>

                <!-- Center Hero Image -->
                <div class="w-full md:w-2/4 flex justify-center items-center px-4 mb-8 md:mb-0">
                    <div class="w-48 h-48 md:w-64 md:h-64 flex items-center justify-center relative">
                        <div class="absolute inset-0 bg-red-100 rounded-full opacity-20 transform scale-110"></div>
                        <img src="{{ asset('storage/hero.png') }}" alt="Hero Donor" class="max-w-full max-h-full relative z-10">
                    </div>
                </div>

                <!-- Right Side Rewards -->
                <div class="w-full md:w-1/4 flex flex-col items-center">
                    <!-- Prestige Badges -->
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full text-red-600 mx-auto mb-3 border border-red-200 shadow-sm hover:shadow transition-all duration-300">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 text-sm">Prestige Badges</h3>
                    </div>

                    <!-- Honor Certificates -->
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full text-red-600 mx-auto mb-3 border border-red-200 shadow-sm hover:shadow transition-all duration-300">
                            <i class="fas fa-certificate text-2xl"></i>
                        </div>
                        <h3 class="font-medium text-gray-900 text-sm">Honor Certificates</h3>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{route('register')}}" class="inline-flex items-center justify-center px-8 py-4 bg-red-600 text-white text-base font-medium rounded-lg shadow-md hover:bg-red-700 transition-all duration-300">
                    <i class="fas fa-user-plus mr-2"></i> Become a Donor
                </a>
            </div>
        </div>
    </div>

    <!-- Luxurious Testimonials Section -->
    <div class="bg-white py-20">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="text-center mb-14">
                <div class="uppercase text-red-600 text-sm tracking-widest mb-2 font-medium">Testimonials</div>
                <h2 class="font-serif text-3xl text-gray-900 mb-3">Donor Stories</h2>
                <div class="w-24 h-0.5 bg-red-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Hear from our donors about their experiences and why they choose to donate blood regularly.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative">
                    <div class="absolute top-0 right-0 text-red-100 opacity-20 -mt-6 -mr-6">
                        <i class="fas fa-quote-right text-6xl"></i>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mr-4 text-red-600 border border-red-200">
                            <span class="text-red-700 font-serif text-lg">S</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Sophie Martin</h4>
                            <p class="text-gray-500 text-sm">Regular Donor • 5 years</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic relative z-10">
                        "I've been donating blood for over 5 years now. It's such a simple way to make a huge impact.
                        The staff are always friendly and the process is quick and easy."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative">
                    <div class="absolute top-0 right-0 text-red-100 opacity-20 -mt-6 -mr-6">
                        <i class="fas fa-quote-right text-6xl"></i>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mr-4 text-red-600 border border-red-200">
                            <span class="text-red-700 font-serif text-lg">T</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Thomas Dubois</h4>
                            <p class="text-gray-500 text-sm">First-time Donor</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic relative z-10">
                        "I was nervous about donating for the first time, but the team made me feel so comfortable.
                        Knowing my donation could save up to three lives makes it all worthwhile."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative">
                    <div class="absolute top-0 right-0 text-red-100 opacity-20 -mt-6 -mr-6">
                        <i class="fas fa-quote-right text-6xl"></i>
                    </div>
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mr-4 text-red-600 border border-red-200">
                            <span class="text-red-700 font-serif text-lg">L</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Lea Bernard</h4>
                            <p class="text-gray-500 text-sm">Monthly Donor</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic relative z-10">
                        "After my sister needed blood transfusions, I realized how important regular donors are.
                        Now I donate every month and encourage all my friends to join me."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Luxurious Call to Action Section -->
    <div class="bg-gradient-to-r from-red-700 to-red-800 py-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <path fill="#FFFFFF" d="M45.7,-76.5C58.9,-69.7,69.3,-56.3,76.3,-41.6C83.3,-26.9,86.9,-10.9,85.6,4.7C84.3,20.3,78.1,35.5,68.7,48.1C59.3,60.7,46.6,70.8,32.6,76.3C18.6,81.8,3.2,82.7,-12.4,80.1C-28.1,77.5,-44,71.3,-56.4,60.8C-68.8,50.3,-77.7,35.5,-81.8,19.3C-85.9,3.1,-85.2,-14.5,-79.3,-29.8C-73.4,-45.1,-62.3,-58.1,-48.6,-64.7C-34.9,-71.3,-18.5,-71.5,-1.3,-69.5C15.9,-67.5,32.5,-83.3,45.7,-76.5Z" transform="translate(100 100)" />
            </svg>
        </div>

        <div class="container mx-auto px-6 max-w-4xl text-center relative z-10">
            <h2 class="font-serif text-4xl text-white mb-6">Ready to Make a Difference?</h2>
            <p class="text-red-100 mb-10 max-w-2xl mx-auto text-lg">
                Your donation can save up to three lives. Join our community of donors today and be part of something meaningful.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{route('appointments.create')}}" class="inline-flex items-center justify-center px-10 py-4 bg-white text-red-700 text-base font-medium rounded-lg shadow-md hover:bg-red-50 transition-all duration-300">
                    <i class="fas fa-calendar-alt mr-2"></i> Schedule a Donation
                </a>
            </div>
        </div>
    </div>

    <!-- Luxurious Elite Donors Section -->
    <div class="bg-white py-20">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="text-center mb-14">
                <div class="uppercase text-red-600 text-sm tracking-widest mb-2 font-medium">Exclusive Community</div>
                <h2 class="font-serif text-3xl text-gray-900 mb-3">Join the Elite Donors</h2>
                <div class="w-24 h-0.5 bg-red-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Not everyone takes the first step... But sometimes, all it takes is inspiration.
                    You may have been inspired by someone else.
                    Today, you can be that light for others.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 z-0 group-hover:bg-red-100 transition-colors duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-6 text-red-600 border border-red-200 shadow-sm">
                            <i class="fas fa-medal text-xl"></i>
                        </div>
                        <h3 class="font-serif text-xl text-gray-900 mb-3">Be a Role Model</h3>
                        <p class="text-gray-600 mb-4">
                            Become a leader in your community. Your commitment to donation inspires others and earns you recognition as a hero who saves lives.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 z-0 group-hover:bg-red-100 transition-colors duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-6 text-red-600 border border-red-200 shadow-sm">
                            <i class="fas fa-bullhorn text-xl"></i>
                        </div>
                        <h3 class="font-serif text-xl text-gray-900 mb-3">Show Your Commitment</h3>
                        <p class="text-gray-600 mb-4">
                            Display your engagement proudly and demonstrate the real impact you're making in your community through regular blood donation.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg p-8 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 z-0 group-hover:bg-red-100 transition-colors duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-6 text-red-600 border border-red-200 shadow-sm">
                            <i class="fas fa-heart text-xl"></i>
                        </div>
                        <h3 class="font-serif text-xl text-gray-900 mb-3">Share Your Story</h3>
                        <p class="text-gray-600 mb-4">
                            Your personal journey can motivate hundreds or even thousands of others to join the cause and become blood donors themselves.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-14">
                <a href="{{route('register')}}" class="inline-flex items-center justify-center px-10 py-4 bg-red-600 text-white text-base font-medium rounded-lg shadow-md hover:bg-red-700 transition-all duration-300">
                    <i class="fas fa-star mr-2"></i> Become an Elite Donor
                </a>
            </div>
        </div>
    </div>

    <!-- Enhanced Blood Type Compatibility Section -->
    <div class=" py-20 border-t border-gray-100">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="text-center mb-12">
                <div class="uppercase text-red-600 text-sm tracking-widest mb-2 font-medium">Know Your Type</div>
                <h2 class="font-serif text-3xl text-gray-900 mb-3">Blood Type Compatibility</h2>
                <div class="w-24 h-0.5 bg-red-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Understanding blood type compatibility is crucial for effective donations.
                    Find out which blood types you can donate to and receive from.
                </p>
            </div>

            <div class="">
                <div class="md:hidden border-b border-gray-100">
                    <div class="flex">
                        <button class="w-1/2 py-4 px-4 text-center font-medium text-red-600 border-b-2 border-red-600">
                            Donate To
                        </button>
                        <button class="w-1/2 py-4 px-4 text-center font-medium text-gray-500 hover:text-gray-700">
                            Receive From
                        </button>
                    </div>
                </div>

                <!-- Desktop view with side-by-side panels -->
                <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    <!-- Donate To Panel -->
                    <div class="p-8">
                        <div class="flex items-center justify-center mb-6">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                <i class="fas fa-hand-holding-medical text-red-600"></i>
                            </div>
                            <h3 class="font-serif text-xl text-gray-900">Who You Can Donate To</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- A+ -->
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-5 rounded-lg border border-red-200 overflow-hidden">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-red-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-red-700">A+</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type A Positive</h4>
                                        <p class="text-xs text-gray-500">36% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can donate to:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">A+</span>
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB+</span>
                                    </div>
                                </div>
                            </div>

                            <!-- A- -->
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-5 rounded-lg border border-red-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-red-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-red-700">A-</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type A Negative</h4>
                                        <p class="text-xs text-gray-500">6.3% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can donate to:</p>
                                    <div class="flex flex-wrap gap-1 justify-around">
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">A+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">A-</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- B+ -->
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-5 rounded-lg border border-red-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-red-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-red-700">B+</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type B Positive</h4>
                                        <p class="text-xs text-gray-500">8.5% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can donate to:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">B+</span>
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB+</span>
                                    </div>
                                </div>
                            </div>

                            <!-- B- -->
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-5 rounded-lg border border-red-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-red-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-red-700">B-</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type B Negative</h4>
                                        <p class="text-xs text-gray-500">1.5% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can donate to:</p>
                                    <div class="flex flex-wrap gap-1 items-center justify-between">
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">B+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">B-</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- O+ -->
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-5 rounded-lg border border-red-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-red-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-red-700">O+</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type O Positive</h4>
                                        <p class="text-xs text-gray-500">37.4% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can donate to:</p>
                                    <div class="flex flex-wrap gap-1 items-center justify-between">
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">O+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">A+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">B+</span>
                                        <span class="inline-block px-1 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">AB+</span>
                                    </div>
                                </div>
                            </div>

                            <!-- O- -->
                            <div class="bg-gradient-to-r from-red-50 to-red-100 p-5 rounded-lg border border-red-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-red-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-red-700">O-</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type O Negative</h4>
                                        <p class="text-xs text-gray-500">6.6% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can donate to:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-block px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">All Types</span>
                                        <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">Universal Donor</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Receive From Panel -->
                    <div class="p-8">
                        <div class="flex items-center justify-center mb-6">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-syringe text-blue-600"></i>
                            </div>
                            <h3 class="font-serif text-xl text-gray-900">Who You Can Receive From</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- A+ -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-blue-700">A+</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type A Positive</h4>
                                        <p class="text-xs text-gray-500">36% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can receive from:</p>
                                    <div class="flex flex-wrap gap-1 items-center justify-between">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">A+</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">A-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O+</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- A- -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-blue-700">A-</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type A Negative</h4>
                                        <p class="text-xs text-gray-500">6.3% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can receive from:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">A-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- B+ -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-blue-700">B+</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type B Positive</h4>
                                        <p class="text-xs text-gray-500">8.5% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can receive from:</p>
                                    <div class="flex flex-wrap gap-1 items-center justify-between">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">B+</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">B-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O+</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- B- -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-blue-700">B-</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type B Negative</h4>
                                        <p class="text-xs text-gray-500">1.5% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can receive from:</p>
                                    <div class="flex flex-wrap gap-1 ">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">B-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- AB+ -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-blue-700">AB+</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type AB Positive</h4>
                                        <p class="text-xs text-gray-500">3.4% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can receive from:</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">All Types</span>
                                        <span class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">Universal Recipient</span>
                                    </div>
                                </div>
                            </div>

                            <!-- AB- -->
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-300 flex items-center justify-center mr-4 shadow-sm">
                                        <span class="text-xl font-bold text-blue-700">AB-</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Type AB Negative</h4>
                                        <p class="text-xs text-gray-500">0.6% of population</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-md p-3 shadow-sm">
                                    <p class="text-sm text-gray-700 mb-1 font-medium">Can receive from:</p>
                                    <div class="flex flex-wrap gap-1 items-center justify-between">
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">A-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">B-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">AB-</span>
                                        <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">O-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
