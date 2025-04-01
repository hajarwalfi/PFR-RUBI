@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Dossier Médical')

@section('content')
    <main   class="flex-1">
        <div class="flex-1">
            <!-- Navigation -->
            <div class="p-4 flex justify-between items-center border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <a href="#" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <span class="text-gray-500">Donneurs > Dossier Médical</span>
                </div>

                <button class="bg-black text-white px-4 py-2 rounded-md flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    <span>Modifier le profil</span>
                </button>
            </div>

            <!-- Informations du donneur -->
            <div class="p-6">
                <!-- Nom et statut -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-1">Hajar Walfi</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-600">203/2025</span>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Régulier</span>
                    </div>
                </div>

                <!-- Sections d'information avec grid personnalisée -->
                <div class="grid grid-cols-12 gap-6">
                    <!-- Informations personnelles -->
                    <div class="col-span-12 md:col-span-4 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Titre de la section -->
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">Informations Personnelles</h3>
                                <p class="text-xs text-gray-500">Coordonnées et détails du donneur</p>
                            </div>
                        </div>

                        <!-- Groupe sanguin -->
                        <div class="p-4 border-b border-gray-200 flex">
                            <div class="flex items-center justify-center w-16 h-16">
                                <div class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 flex justify-between items-center">
                                <div class="text-xl font-bold">O+</div>
                                <div class="text-green-600 font-medium">Éligible</div>
                            </div>
                        </div>

                        <!-- Identité CIN -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                <span class="text-gray-600 text-xs ">Identité CIN</span>
                            </div>
                            <p class="font-medium text-sm pl-7">HH126970</p>
                        </div>

                        <!-- Date de naissance -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-600 text-xs">Date de naissance</span>
                            </div>
                            <p class="font-medium pl-7 text-sm ">24/07/2002</p>
                        </div>

                        <!-- Téléphone -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-600 text-xs">Téléphone</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">0691754844</p>
                        </div>

                        <!-- Email -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-600 text-xs">Email</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">wh.hajarwalfi@gmail.com</p>
                        </div>

                        <!-- Adresse -->
                        <div class="p-4">
                            <div class="flex items-center mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-600 text-xs">Adresse</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">Lot El Madina, Route Taka, Safi</p>
                        </div>
                    </div>

                    <!-- Historique des dons -->
                    <div class="col-span-12 md:col-span-8 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Titre de la section -->
                        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold">Historique des dons</h3>
                                    <p class="text-xs text-gray-500">Coordonnées et détails du donneur</p>
                                </div>
                            </div>
                            <button class="bg-black text-white px-3 py-2 rounded-md flex items-center text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Ajouter un don
                            </button>
                        </div>

                        <!-- Tableau des dons -->
                        <div>
                            <table class="min-w-full divide-y divide-gray-200 rounded-md">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sérologie</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Don 1 -->
                                <tr>
                                    <td class="px-6 py-4  text-xs text-left text-gray-900">DON-2022-089</td>
                                    <td class="px-6 py-4  text-xs text-left text-gray-500">01/01/2022</td>
                                    <td class="px-6 py-4  text-xs text-left text-gray-500">volontaire</td>
                                    <td class="px-6 py-4 ">
                                      <span class="flex items-center text-xs text-green-600">
                                        <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Négative
                                      </span>
                                    </td>
                                    <td class="px-6 py-4  text-center text-sm font-medium">
                                        <button class="text-gray-400 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Don 1 -->
                                <tr>
                                    <td class="px-6 py-4  text-xs text-left text-gray-900">DON-2022-089</td>
                                    <td class="px-6 py-4  text-xs text-left text-gray-500">01/01/2022</td>
                                    <td class="px-6 py-4  text-xs text-left text-gray-500">volontaire</td>
                                    <td class="px-6 py-4 ">
                                      <span class="flex items-center text-xs text-green-600">
                                        <svg class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Négative
                                      </span>
                                    </td>
                                    <td class="px-6 py-4  text-center text-sm font-medium">
                                        <button class="text-gray-400 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
