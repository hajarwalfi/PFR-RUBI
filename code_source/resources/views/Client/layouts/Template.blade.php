<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RUBI')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body >
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-2 h-18">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="flex-shrink-0">
                    <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="h-12 w-12">
                </a>
            </div>

            <nav class="hidden md:flex items-center font-semibold text-md space-x-8">
                <a href="#" class="text-red-500">Home</a>
                <a href="#" class="text-gray-800 hover:text-red-500">Articles</a>
                <a href="#" class="text-gray-800 hover:text-red-500">Community</a>
                <a href="#" class="text-gray-800 hover:text-red-500">About</a>
                <a href="#" class="text-gray-800 hover:text-red-500">Contact</a>
            </nav>

            <div class="flex items-center space-x-4">
                <a href="#" class="text-red-500">
                    <i class="fa-solid fa-user"></i>
                </a>
                <a href="#" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md font-medium text-sm">
                    Devenir Donneur
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile menu (hidden by default) -->
<div class="md:hidden hidden bg-white border-t border-gray-200">
    <div class="container mx-auto px-6 py-3">
        <div class="flex flex-col space-y-3">
            <a href="#" class="text-red-500 font-medium">Acceuil</a>
            <a href="#" class="text-gray-800 hover:text-red-500">Sensibilisation</a>
            <a href="#" class="text-gray-800 hover:text-red-500">Communauté</a>
            <a href="#" class="text-gray-800 hover:text-red-500">A propos</a>
            <a href="#" class="text-gray-800 hover:text-red-500">Contactez-nous</a>
        </div>
    </div>
</div>

<main>
    @yield('content')
</main>


<footer class="bg-white mt-16 rounded-t-3xl border-t border-red-500 shadow-lg">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column - Contact & Support -->
            <div class="flex flex-col items-start">
                <h3 class="text-red-600 font-semibold text-lg mb-4">Contact & Support</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>0523464781</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>crts.safi@gmail.com</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>safi, Hopital MV</span>
                    </div>
                </div>
            </div>

            <!-- Center Column - Logo and Tagline -->
            <div class="flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-red-500 w-full h-full">
                        <path fill="currentColor" d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                    </svg>
                </div>
                <p class="text-red-600 font-medium text-center max-w-xs">
                    Parce que les vrais héros ne portent pas de capes...<br>
                    ils tendent simplement le bras.
                </p>
            </div>

            <!-- Right Column - Quick Links -->
            <div class="flex flex-col items-end">
                <h3 class="text-red-600 font-semibold text-lg mb-4">Liens rapides</h3>
                <div class="space-y-2">
                    <a href="" class="block text-gray-700 hover:text-red-600 transition-colors">Acceuil</a>
                    <a href="" class="block text-gray-700 hover:text-red-600 transition-colors">Test d'éligibilité</a>
                    <a href="" class="block text-gray-700 hover:text-red-600 transition-colors">FAQ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-gray-100 py-4">
        <div class="container mx-auto px-4">
            <p class="text-center text-gray-600 text-sm">
                RUBI - Pormotion du don de sang. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>

</body>
</html>
