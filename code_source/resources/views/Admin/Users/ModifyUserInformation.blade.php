@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Modifier le dossier médical')

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
        <span class="font-medium">Modifier le profil</span>
    </div>

    <!-- Main Form Container -->
    <div class="bg-white rounded-md p-6">
        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-1">Modifier le profil du donneur</h1>
        <p class="text-sm text-gray-600 mb-6">Mettez à jour les informations personnelles et médicales du donneur</p>

        <!-- Donor Information Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Informations du don</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" id="nom" placeholder="entrer le nom du donneur" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Prénom -->
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                    <input type="text" id="prenom" placeholder="entrer le prénom du donneur" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Date de naissance -->
                <div>
                    <label for="date-naissance" class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                    <input type="text" id="date-naissance" placeholder="JJ/MM/AAAA" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Identité CIN -->
                <div>
                    <label for="cin" class="block text-sm font-medium text-gray-700 mb-1">Identité CIN</label>
                    <input type="text" id="cin" placeholder="ex:AB123456" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                    <input type="text" id="telephone" placeholder="06XXXXXXXX" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" placeholder="exemple@email.com" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
            </div>

            <!-- Adresse -->
            <div class="mt-6">
                <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                <input type="text" id="adresse" placeholder="123 Rue Casablanca, 1234" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Groupe Sanguin -->
            <div class="mt-6">
                <label for="groupe-sanguin" class="block text-sm font-medium text-gray-700 mb-1">Groupe Sanguin</label>
                <div class="relative">
                    <select id="groupe-sanguin" class="w-full px-3 py-2 border border-gray-300 rounded-md appearance-none pr-10">
                        <option value="">Sélectionner un groupe sanguin</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
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
