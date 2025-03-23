<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RUBI Admin - Donneurs</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-white font-Geist ">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 border-r border-gray-200 bg-white">
        <div class="p-6 font-bold text-xl">RUBI Admin</div>
    </div>

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <div class ="p-8">
            <h1 class="text-3xl font-bold ">Donneurs</h1>
            <p class="text-l font-regular text-gray-500 ">Gérez les donneurs de sang enregistrés dans l'application RUBI</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 mb-8">
            <!-- Total Donneurs -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-lg">Total Donneurs</h2>
                    <div class="p-2 rounded-full">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                </div>
                <div class="text-4xl font-bold mb-1">40</div>
                <div class="text-gray-500 text-sm">Tous les donneurs enregistrés</div>
            </div>

            <!-- Donneurs Eligibles -->


            <!-- Donneurs Inéligibles -->

        </div>

        <!-- Donor Management Section -->
        <div class="bg-white rounded-lg border border-gray-200 mx-8 mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold mb-1">Gestion des donneurs</h2>
                <p class="text-gray-500 text-sm">Consultez et gérez les donneurs de sang enregistrés dans l'application RUBI</p>
            </div>

            <!-- Search and Filters -->
            <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-auto">
                    <input type="text" placeholder="Rechercher un donneur..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full md:w-80 text-sm">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm">Eligibles</button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm">Inéligibles</button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="px-6 py-3 font-medium text-gray-600">Nom & Prénom</th>
                        <th class="px-6 py-3 font-medium text-gray-600">Groupe Sanguin</th>
                        <th class="px-6 py-3 font-medium text-gray-600">État</th>
                        <th class="px-6 py-3 font-medium text-gray-600">Téléphone</th>
                        <th class="px-6 py-3 font-medium text-gray-600">Email</th>
                        <th class="px-6 py-3 font-medium text-gray-600">Dernier Don</th>
                        <th class="px-6 py-3 font-medium text-gray-600">Éligibilité</th>
                        <th class="px-6 py-3 font-medium text-gray-600">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Row 1 -->
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">Benali Sara</td>
                        <td class="px-6 py-4">O-</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs">Occasionnel</span>
                        </td>
                        <td class="px-6 py-4">0699765432</td>
                        <td class="px-6 py-4">sara.benali@example.com</td>
                        <td class="px-6 py-4">05/03/2023</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs">Éligible</span>
                        </td>
                        <td class="px-6 py-4 relative">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">Benali Sara</td>
                        <td class="px-6 py-4">O-</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs">Régulier</span>
                        </td>
                        <td class="px-6 py-4">0699765432</td>
                        <td class="px-6 py-4">sara.benali@example.com</td>
                        <td class="px-6 py-4">05/03/2023</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs">Non Éligible</span>
                        </td>
                        <td class="px-6 py-4 relative">
                            <div class="relative inline-block text-left">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">Benali Sara</td>
                        <td class="px-6 py-4">O-</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs">Occasionnel</span>
                        </td>
                        <td class="px-6 py-4">0699765432</td>
                        <td class="px-6 py-4">sara.benali@example.com</td>
                        <td class="px-6 py-4">05/03/2023</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs">Éligible</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">Benali Sara</td>
                        <td class="px-6 py-4">O-</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs">Nouveau</span>
                        </td>
                        <td class="px-6 py-4">0699765432</td>
                        <td class="px-6 py-4">sara.benali@example.com</td>
                        <td class="px-6 py-4">05/03/2023</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs">Éligible</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 5 -->
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">Benali Sara</td>
                        <td class="px-6 py-4">O-</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs">Occasionnel</span>
                        </td>
                        <td class="px-6 py-4">0699765432</td>
                        <td class="px-6 py-4">sara.benali@example.com</td>
                        <td class="px-6 py-4">05/03/2023</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs">Éligible</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 6 -->
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">Benali Sara</td>
                        <td class="px-6 py-4">O-</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs">Occasionnel</span>
                        </td>
                        <td class="px-6 py-4">0699765432</td>
                        <td class="px-6 py-4">sara.benali@example.com</td>
                        <td class="px-6 py-4">05/03/2023</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs">Éligible</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 flex justify-end items-center border-t border-gray-200">
                <div class="flex items-center gap-2">
                    <button class="p-1 rounded-md border border-gray-300 text-gray-500">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="text-sm">Page 1 sur 1</span>
                    <button class="p-1 rounded-md border border-gray-300 text-gray-500">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
