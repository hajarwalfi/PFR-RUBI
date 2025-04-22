@extends('Client.layouts.Template')

@section('title', 'Home')

@section('content')
    <section class="relative overflow-hidden">
        <div class="relative h-[500px] md:h-[600px] lg:h-[731px] w-full max-w-[1440px] mx-auto">
            <!-- Background image with overlay -->
            <div class="absolute inset-0 bg-cover bg-center "
                 style="background-image: url('{{ asset('storage/mommy.jpg') }}');">
                <!-- Semi-transparent overlay to enhance text readability -->
                <div class="absolute inset-0"></div>
            </div>

            <!-- Content container -->
            <div class="relative h-full flex flex-col justify-center p-8 md:p-12 lg:p-16">
                <div class="max-w-xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Donnez du sang,<br>offrez la vie !
                    </h1>

                    <div class="text-white/90 text-lg md:text-xl space-y-2 mb-8">
                        <p>Chaque goutte de sang que vous donnez est une promesse d'avenir.</p>
                        <p>Elle permet à un enfant de grandir, à une mère de serrer son bébé dans ses bras, à une
                            famille de garder espoir.</p>
                    </div>

                    <a href="#"
                       class="inline-block bg-red-500 hover:bg-red-600 text-white font-medium px-8 py-3 rounded-md text-center transition-colors">
                        Devenir Donneur
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-red-600 text-center mb-12">
                Un Geste Simple, Un Impact Immense
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto mb-12">
                <!-- Step 1: Eligibility -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center transition-transform hover:transform hover:scale-105">
                    <div class="flex justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-700" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Testez votre éligibilité</h3>
                    <p class="text-gray-600">Vérifiez si vous pouvez donner du sang en quelques minutes.</p>
                </div>

                <!-- Step 2: Appointment -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center transition-transform hover:transform hover:scale-105">
                    <div class="flex justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-700" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Prenez rendez-vous</h3>
                    <p class="text-gray-600">Choisissez une date et un lieu qui vous conviennent.</p>
                </div>

                <!-- Step 3: Donation -->
                <div
                    class="bg-white rounded-lg shadow-lg p-8 text-center transition-transform hover:transform hover:scale-105">
                    <div class="flex justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-red-700" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Donnez votre sang</h3>
                    <p class="text-gray-600">Un geste simple qui peut sauver jusqu'à trois vies.</p>
                </div>
            </div>

            <div class="flex justify-center">
                <a href=""
                   class="bg-red-500 hover:bg-red-600 text-white font-medium px-8 py-3 rounded-md text-center transition-colors">
                    Vérifier mon éligibilité
                </a>
            </div>
        </div>
    </section>
    <section class="py-16 bg-red-50">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Title -->
            <h2 class="text-3xl md:text-4xl font-bold text-red-600 text-center mb-6">
                Parce que Chaque Héro Mérite une Distinction !
            </h2>

            <!-- Description -->
            <div class="text-center text-gray-800 max-w-3xl mx-auto mb-12">
                <p class="text-lg">
                    Votre générosité ne passe pas inaperçue. Rejoignez notre programme de récompenses et récoltez les
                    fruits de votre engagement !
                </p>
            </div>

            <!-- Rewards layout with superhero in center -->
            <div class="relative mb-12">
                <!-- Top row -->
                <div class="flex justify-between mb-8">
                    <!-- Special Gifts -->
                    <div class="w-1/3 flex flex-col items-center text-center">
                        <div class="w-16 h-16 mb-3 text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 12V22H4V12"/>
                                <path d="M22 7H2V12H22V7Z"/>
                                <path d="M12 22V7"/>
                                <path
                                    d="M12 7H7.5C6.83696 7 6.20107 6.73661 5.73223 6.26777C5.26339 5.79893 5 5.16304 5 4.5C5 3.83696 5.26339 3.20107 5.73223 2.73223C6.20107 2.26339 6.83696 2 7.5 2C11 2 12 7 12 7Z"/>
                                <path
                                    d="M12 7H16.5C17.163 7 17.7989 6.73661 18.2678 6.26777C18.7366 5.79893 19 5.16304 19 4.5C19 3.83696 18.7366 3.20107 18.2678 2.73223C17.7989 2.26339 17.163 2 16.5 2C13 2 12 7 12 7Z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg">Cadeaux Spéciaux</h3>
                    </div>

                    <!-- Empty space for center alignment -->
                    <div class="w-1/3"></div>

                    <!-- Prestige Badges -->
                    <div class="w-1/3 flex flex-col items-center text-center">
                        <div class="w-16 h-16 mb-3 text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg">Badges de Prestige</h3>
                    </div>
                </div>

                <!-- Center superhero -->
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-40 h-48">
                    <img src="{{ asset('storage/hero.png') }}" alt="Blood Donation Hero" class="w-full h-full">
                </div>

                <!-- Bottom row -->
                <div class="flex justify-between">
                    <!-- Loyalty Points -->
                    <div class="w-1/3 flex flex-col items-center text-center">
                        <div class="w-16 h-16 mb-3 text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg">Points de Fidélité</h3>
                    </div>

                    <!-- Empty space for center alignment -->
                    <div class="w-1/3"></div>

                    <!-- Honor Certificates -->
                    <div class="w-1/3 flex flex-col items-center text-center">
                        <div class="w-16 h-16 mb-3 text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <circle cx="12" cy="8" r="7"/>
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg">Certificats d'Honneur</h3>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-center">
                <a href=""
                   class="bg-red-500 hover:bg-red-600 text-white font-medium px-8 py-3 rounded-md text-center transition-colors">
                    Devenir Donneur
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <!-- Title -->
            <h2 class="text-3xl md:text-4xl font-bold text-red-600 text-center mb-6">
                Rejoignez l'Élite des Donneurs
            </h2>

            <!-- Inspirational text -->
            <div class="text-center text-gray-800 max-w-3xl mx-auto mb-12">
                <p class="text-lg mb-2">Tout le monde n'ose pas faire le premier pas...</p>
                <p class="text-lg mb-2">Mais parfois, il suffit d'une inspiration.</p>
                <p class="text-lg mb-2">Vous avez peut-être été inspiré par quelqu'un..</p>
                <p class="text-lg mb-4">Aujourd'hui, c'est vous qui pouvez être cette lumière pour les autres.</p>
            </div>

            <!-- Three cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Card 1 -->
                <div
                    class="bg-red-50 rounded-lg shadow-lg p-8 text-center transition-transform hover:transform hover:scale-105">
                    <p class="text-gray-800 text-lg font-medium">
                        Soyez un modèle, un leader, un héros reconnu.
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-red-50 rounded-lg shadow-lg p-8 text-center transition-transform hover:transform hover:scale-105">
                    <p class="text-gray-800 text-lg font-medium">
                        Affichez votre engagement, montrez votre impact.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-red-50 rounded-lg shadow-lg p-8 text-center transition-transform hover:transform hover:scale-105">
                    <p class="text-gray-800 text-lg font-medium">
                        Votre histoire peut motiver des centaines, peut-être des milliers.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection


