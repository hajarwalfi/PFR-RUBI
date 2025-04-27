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


<footer class="bg-white border-t border-gray-100 pt-16 pb-12">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Section principale du footer -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                <!-- Colonne de gauche - À propos -->
                <div class="md:col-span-4">
                    <div class="mb-6">
                        <!-- Logo ou nom du site -->
                        <h3 class="font-serif text-xl text-gray-900">RUBI</h3>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Notre mission est de sensibiliser le public à l'importance du don de sang et de faciliter ce processus vital qui sauve des vies chaque jour.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-900">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Colonne centrale - Navigation -->
                <div class="md:col-span-3 md:ml-auto">
                    <h4 class="font-serif text-sm text-gray-900 uppercase tracking-wider mb-5">Navigation</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-sm text-gray-600 hover:text-gray-900">Accueil</a></li>
                        <li><a href="#" class="text-sm text-gray-600 hover:text-gray-900">À propos</a></li>
                        <li><a href="#" class="text-sm text-gray-600 hover:text-gray-900">Articles</a></li>
                        <li><a href="#" class="text-sm text-gray-600 hover:text-gray-900">Événements</a></li>
                        <li><a href="#" class="text-sm text-gray-600 hover:text-gray-900">Contact</a></li>
                    </ul>
                </div>

                <!-- Colonne de droite - Contact -->
                <div class="md:col-span-3">
                    <h4 class="font-serif text-sm text-gray-900 uppercase tracking-wider mb-5">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">123 Rue du Don de Sang<br>75000 Paris, France</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">contact@rubi.org</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">+33 (0)1 23 45 67 89</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="border-t border-gray-100 pt-8 pb-12">
                <div class="max-w-md mx-auto text-center">
                    <h4 class="font-serif text-lg text-gray-900 mb-4">Restez informé</h4>
                    <p class="text-sm text-gray-600 mb-6">Abonnez-vous à notre newsletter pour recevoir les dernières actualités sur le don de sang.</p>
                    <form class="flex">
                        <input
                            type="email"
                            placeholder="Votre adresse email"
                            class="flex-1 px-4 py-2 text-sm border border-gray-200 focus:outline-none focus:border-gray-900"
                            required
                        >
                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-900 text-white text-sm hover:bg-gray-800"
                        >
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-100 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-xs text-gray-500 mb-4 md:mb-0">
                        © {{ date('Y') }} RUBI. Tous droits réservés.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-xs text-gray-500 hover:text-gray-900">Politique de confidentialité</a>
                        <a href="#" class="text-xs text-gray-500 hover:text-gray-900">Conditions d'utilisation</a>
                        <a href="#" class="text-xs text-gray-500 hover:text-gray-900">Mentions légales</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
