<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RUBI')</title>
    @vite('resources/css/user.css')
    @vite('resources/js/user.js')
</head>

<body>
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="" class="flex-shrink-0">
                    <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="h-12 w-auto">
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-8">
                <a href="" class="text-red-600 font-medium text-sm hover:text-red-700 transition-colors px-1 py-2 border-b-2 border-red-500 font-serif">
                    Accueil
                </a>
                <a href="" class="text-gray-700 font-medium text-sm hover:text-red-600 transition-colors px-1 py-2 border-b-2 border-transparent hover:border-red-500 font-serif">
                    Articles
                </a>
                <a href="" class="text-gray-700 font-medium text-sm hover:text-red-600 transition-colors px-1 py-2 border-b-2 border-transparent hover:border-red-500 font-serif">
                    Communauté
                </a>
                <a href="" class="text-gray-700 font-medium text-sm hover:text-red-600 transition-colors px-1 py-2 border-b-2 border-transparent hover:border-red-500 font-serif">
                    Éligibilité
                </a>
                <a href="" class="text-gray-700 font-medium text-sm hover:text-red-600 transition-colors px-1 py-2 border-b-2 border-transparent hover:border-red-500 font-serif">
                    À propos
                </a>
            </nav>

            <div class="flex items-center space-x-5">
                @auth
                    <div class="relative hidden md:block">
                        <button type="button" id="userMenuButton" class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                <i class="ri-user-line text-red-600"></i>
                            </div>
                            <span class="ml-2 text-sm hidden lg:inline font-serif">{{ Auth::user()->name }}</span>
                        </button>
                        <div id="userMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                            <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                Mon profil
                            </a>
                            <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                Mes rendez-vous
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden md:block text-sm font-medium text-gray-700 hover:text-red-600 transition-colors font-serif">
                        Connexion
                    </a>
                @endauth

                <a href="{{ route('register') }}" class="hidden sm:inline-flex items-center px-5 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white text-sm font-medium rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-[1.02] shadow-sm font-serif tracking-wide">
                    Devenir Donneur
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button type="button" id="mobileMenuButton" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<div id="mobileMenu" class="md:hidden hidden">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-end mb-8">
            <button type="button" id="closeMobileMenu" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <div class="flex flex-col space-y-4">
            <a href="" class="text-red-600 font-medium py-2 border-l-4 border-red-500 pl-3 font-serif">
                Accueil
            </a>
            <a href="" class="text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                Articles
            </a>
            <a href="" class="text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                Communauté
            </a>
            <a href="" class="text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                Éligibilité
            </a>
            <a href="" class="text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                À propos
            </a>

            @auth
                <a href="" class="text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                    <i class="ri-user-line mr-2"></i> Mon profil
                </a>
                <a href="" class="text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                    <i class="ri-calendar-line mr-2"></i> Mes rendez-vous
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-gray-700 hover:text-red-600 py-2 border-l-4 border-transparent hover:border-red-500 pl-3 transition-colors font-serif">
                        <i class="ri-logout-box-line mr-2"></i> Déconnexion
                    </button>
                </form>
            @else
                <div class="border-t border-gray-100 pt-4 mt-2">
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-red-600 font-medium py-2 font-serif">
                            <i class="ri-login-box-line mr-2"></i> Connexion
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-600 to-red-700 text-white font-medium py-3 px-4 rounded-lg text-center shadow-sm font-serif tracking-wide">
                            Devenir Donneur
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<main>
    @yield('content')
</main>


<footer class="bg-white border-t border-gray-100 pt-16 pb-12">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                <div class="md:col-span-4">
                    <div class="mb-6">
                        <h3 class="font-serif text-xl text-gray-900">RUBI</h3>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed mb-6">
                        Notre mission est de sensibiliser le public à l'importance du don de sang et de faciliter ce processus vital qui sauve des vies chaque jour.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-900">
                            <span class="sr-only">Facebook</span>
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900">
                            <span class="sr-only">Twitter</span>
                            <i class="ri-twitter-fill"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-900">
                            <span class="sr-only">Instagram</span>
                            <i class="ri-instagram-line"></i>
                        </a>
                    </div>
                </div>

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

                <div class="md:col-span-3">
                    <h4 class="font-serif text-sm text-gray-900 uppercase tracking-wider mb-5">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="ri-map-pin-line text-gray-400 mr-3 mt-0.5"></i>
                            <span class="text-sm text-gray-600">123 Blood Donation Street<br>75000 Paris, France</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-mail-line text-gray-400 mr-3 mt-0.5"></i>
                            <span class="text-sm text-gray-600">contact@rubi.org</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-phone-line text-gray-400 mr-3 mt-0.5"></i>
                            <span class="text-sm text-gray-600">+33 (0)1 23 45 67 89</span>
                        </li>
                    </ul>
                </div>
            </div>

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
