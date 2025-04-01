@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Ajouter un don')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-gray-600 mb-6">
            <a href="#" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <a href="#" class="hover:underline">Donneurs</a>
            <span class="mx-2">></span>
            <a href="#" class="hover:underline">Dossier Médical</a>
            <span class="mx-2">></span>
            <span class="font-medium">Détails du don</span>
        </div>

        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-1">Modifier le don DON-2022-089</h1>
        <p class="text-sm text-gray-600 mb-6">Modifier les informations du don en sang</p>

        <!-- Donation Information Section -->
        <div class="bg-white rounded-md border border-gray-200 p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Informations du don</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date du don -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date du don</label>
                    <input type="text" id="date" value="03/02/2023" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="JJ/MM/AAAA">
                </div>

                <!-- Type du don -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type du don</label>
                    <input type="text" id="type" value="Volontaire" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Lieu du don -->
                <div>
                    <label for="lieu" class="block text-sm font-medium text-gray-700 mb-1">Lieu du don</label>
                    <input type="text" id="lieu" placeholder="Centre de transfusion, hôpital, etc." class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Quantité prélevée -->
                <div>
                    <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">Quantité prélevée (ml)</label>
                    <input type="text" id="quantite" value="450" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Opérateur -->
                <div>
                    <label for="operateur" class="block text-sm font-medium text-gray-700 mb-1">Opérateur</label>
                    <input type="text" id="operateur" placeholder="Nom du médecin ou infirmier..." class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">
                <button class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium">Annuler</button>
                <button class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Sauvegarder
                </button>
            </div>
        </div>

        <!-- Serology Information Section -->
        <div class="bg-white rounded-md border border-gray-200 p-6">
            <h2 class="text-lg font-semibold mb-4">Informations de sérologie</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- TPHA -->
                <div>
                    <label for="tpha" class="block text-sm font-medium text-gray-700 mb-1">TPHA</label>
                    <div class="relative">
                        <select id="tpha" class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none pr-10">
                            <option>Négatif</option>
                            <option>Positif</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- HB -->
                <div>
                    <label for="hb" class="block text-sm font-medium text-gray-700 mb-1">HB</label>
                    <div class="relative">
                        <select id="hb" class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none pr-10">
                            <option>Négatif</option>
                            <option>Positif</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- HC -->
                <div>
                    <label for="hc" class="block text-sm font-medium text-gray-700 mb-1">HC</label>
                    <div class="relative">
                        <select id="hc" class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none pr-10">
                            <option>Négatif</option>
                            <option>Positif</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- VIH -->
                <div>
                    <label for="vih" class="block text-sm font-medium text-gray-700 mb-1">VIH</label>
                    <div class="relative">
                        <select id="vih" class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none pr-10">
                            <option>Négatif</option>
                            <option>Positif</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">
                <button class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium">Annuler</button>
                <button class="px-4 py-2 bg-black text-white rounded-md text-sm font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Sauvegarder
                </button>
            </div>
        </div>
    </main>
@endsection
