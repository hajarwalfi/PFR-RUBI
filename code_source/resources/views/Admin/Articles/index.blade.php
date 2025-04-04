@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Donors')


@section('content')
<body class="bg-white">
<div class="flex h-screen">

    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <main class="container mx-auto px-4 py-8 max-w-7xl">
            <div class="space-y-6">
                <!-- Statistiques en haut -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                    <div class="bg-white rounded-lg border shadow-sm p-4">
                        <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="text-sm font-medium">Total Publications</h3>
                            <i class="ri-file-text-line text-gray-500 h-4 w-4"></i>
                        </div>
                        <div class="text-2xl font-bold">5</div>
                        <p class="text-xs text-gray-500">Toutes les publications</p>
                    </div>
                    <div class="bg-white rounded-lg border shadow-sm p-4">
                        <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="text-sm font-medium">Publiées</h3>
                            <span class="inline-flex items-center rounded-full border border-green-200 bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                              3
                            </span>
                        </div>
                        <div class="text-2xl font-bold">60.0%</div>
                        <p class="text-xs text-gray-500">Publications actives</p>
                    </div>
                    <div class="bg-white rounded-lg border shadow-sm p-4">
                        <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="text-sm font-medium">Brouillons</h3>
                            <span class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-50 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                              1
                            </span>
                        </div>
                        <div class="text-2xl font-bold">20.0%</div>
                        <p class="text-xs text-gray-500">En cours de rédaction</p>
                    </div>
                    <div class="bg-white rounded-lg border shadow-sm p-4">
                        <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                            <h3 class="text-sm font-medium">Archivées</h3>
                            <span class="inline-flex items-center rounded-full border border-gray-200 bg-gray-50 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                              1
                            </span>
                        </div>
                        <div class="text-2xl font-bold">20.0%</div>
                        <p class="text-xs text-gray-500">Publications inactives</p>
                    </div>
                </div>

                <!-- Tableau principal -->
                <div class="bg-white rounded-lg border shadow-sm">
                    <div class="p-4 border-b">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h2 class="text-lg font-semibold">Gestion des publications</h2>
                                <p class="text-sm text-gray-500">Consultez et gérez toutes les publications officielles</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-3">
                                    <i class="ri-download-line mr-2 h-4 w-4"></i>
                                    Exporter
                                </button>
                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-3">
                                    <i class="ri-refresh-line mr-2 h-4 w-4"></i>
                                    Actualiser
                                </button>
                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-3">
                                    <i class="ri-add-circle-line mr-2 h-4 w-4"></i>
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-y bg-gray-50">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="relative w-full sm:w-64">
                                <i class="ri-search-line absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
                                <input
                                    type="search"
                                    placeholder="Rechercher une publication..."
                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 pl-8"
                                />
                            </div>
                            <div class="flex gap-2">
                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 w-full sm:w-auto">
                                    <i class="ri-filter-line mr-2 h-4 w-4"></i>
                                    Afficher les filtres
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="w-full">
                        <div class="px-4 pt-2">
                            <div class="inline-flex h-10 items-center justify-center rounded-md bg-muted p-1 text-muted-foreground grid w-full grid-cols-4">
                                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm bg-background text-foreground shadow-sm">
                                    Tous
                                </button>
                                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">
                                    Publiés
                                </button>
                                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">
                                    Brouillons
                                </button>
                                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium ring-offset-background transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 data-[state=active]:bg-background data-[state=active]:text-foreground data-[state=active]:shadow-sm">
                                    Archivés
                                </button>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <!-- Publication Card 1 -->
                                <div class="bg-white rounded-lg border shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                    <div class="p-4 pb-2">
                                        <div class="flex justify-between items-start">
                                            <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                              Publié
                                            </span>
                                            <div class="relative">
                                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0 action-btn" onclick="toggleDropdown(this)">
                                                    <span class="sr-only">Ouvrir le menu</span>
                                                    <i class="ri-more-2-fill h-4 w-4"></i>
                                                </button>
                                                <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                                    <div class="py-1">
                                                        <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-eye-line mr-2"></i> Voir les détails
                                                        </a>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-edit-line mr-2"></i> Modifier
                                                        </a>
                                                        <button class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left" onclick="openDeleteDialog()">
                                                            <i class="ri-delete-bin-line mr-2"></i> Supprimer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-semibold mt-2 line-clamp-2">Campagne de don de sang - Été 2023</h3>
                                    </div>
                                    <div class="p-4 pt-0">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                            <i class="ri-calendar-line h-4 w-4"></i>
                                            <span>15/06/2023</span>
                                            <span class="mx-1">•</span>
                                            <i class="ri-user-line h-4 w-4"></i>
                                            <span>Dr. Mohammed Alaoui</span>
                                        </div>
                                        <span class="inline-flex items-center rounded-md border border-input px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 mb-3 font-medium">
                                            Événement
                                        </span>
                                        <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                                            Nous organisons une grande campagne de don de sang durant tout l'été 2023. Venez nombreux pour sauver des vies !
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Don de sang
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Campagne
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Été 2023
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4 pt-0 flex justify-between items-center border-t">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="ri-eye-line h-4 w-4"></i>
                                            <span>1245 vues</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>

                                <!-- Publication Card 2 -->
                                <div class="bg-white rounded-lg border shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                    <div class="p-4 pb-2">
                                        <div class="flex justify-between items-start">
                                            <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                              Publié
                                            </span>
                                            <div class="relative">
                                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0 action-btn" onclick="toggleDropdown(this)">
                                                    <span class="sr-only">Ouvrir le menu</span>
                                                    <i class="ri-more-2-fill h-4 w-4"></i>
                                                </button>
                                                <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                                    <div class="py-1">
                                                        <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-eye-line mr-2"></i> Voir les détails
                                                        </a>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-edit-line mr-2"></i> Modifier
                                                        </a>
                                                        <button class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left" onclick="openDeleteDialog()">
                                                            <i class="ri-delete-bin-line mr-2"></i> Supprimer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-semibold mt-2 line-clamp-2">Nouveaux horaires des centres de don</h3>
                                    </div>
                                    <div class="p-4 pt-0">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                            <i class="ri-calendar-line h-4 w-4"></i>
                                            <span>20/06/2023</span>
                                            <span class="mx-1">•</span>
                                            <i class="ri-user-line h-4 w-4"></i>
                                            <span>Fatima Benali</span>
                                        </div>
                                        <span class="inline-flex items-center rounded-md border border-input px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 mb-3 font-medium">
                                            Annonce
                                        </span>
                                        <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                                            À partir du 1er juillet, les centres de don de sang adopteront de nouveaux horaires pour mieux vous accueillir.
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Horaires
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Centres de don
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4 pt-0 flex justify-between items-center border-t">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="ri-eye-line h-4 w-4"></i>
                                            <span>876 vues</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>

                                <!-- Publication Card 3 -->
                                <div class="bg-white rounded-lg border shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                    <div class="p-4 pb-2">
                                        <div class="flex justify-between items-start">
                                            <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                              Publié
                                            </span>
                                            <div class="relative">
                                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0 action-btn" onclick="toggleDropdown(this)">
                                                    <span class="sr-only">Ouvrir le menu</span>
                                                    <i class="ri-more-2-fill h-4 w-4"></i>
                                                </button>
                                                <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                                    <div class="py-1">
                                                        <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-eye-line mr-2"></i> Voir les détails
                                                        </a>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-edit-line mr-2"></i> Modifier
                                                        </a>
                                                        <button class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left" onclick="openDeleteDialog()">
                                                            <i class="ri-delete-bin-line mr-2"></i> Supprimer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-semibold mt-2 line-clamp-2">Résultats de la campagne universitaire</h3>
                                    </div>
                                    <div class="p-4 pt-0">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                            <i class="ri-calendar-line h-4 w-4"></i>
                                            <span>05/07/2023</span>
                                            <span class="mx-1">•</span>
                                            <i class="ri-user-line h-4 w-4"></i>
                                            <span>Karim El Amrani</span>
                                        </div>
                                        <span class="inline-flex items-center rounded-md border border-input px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 mb-3 font-medium">
                                            Communiqué
                                        </span>
                                        <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                                            La campagne de don organisée dans les universités a permis de collecter plus de 500 poches de sang. Merci à tous les participants !
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Université
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Résultats
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Remerciements
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4 pt-0 flex justify-between items-center border-t">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="ri-eye-line h-4 w-4"></i>
                                            <span>543 vues</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>

                                <!-- Publication Card 4 (Brouillon) -->
                                <div class="bg-white rounded-lg border shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                    <div class="p-4 pb-2">
                                        <div class="flex justify-between items-start">
                                            <span class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-50 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                                              Brouillon
                                            </span>
                                            <div class="relative">
                                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0 action-btn" onclick="toggleDropdown(this)">
                                                    <span class="sr-only">Ouvrir le menu</span>
                                                    <i class="ri-more-2-fill h-4 w-4"></i>
                                                </button>
                                                <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                                    <div class="py-1">
                                                        <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-eye-line mr-2"></i> Voir les détails
                                                        </a>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-edit-line mr-2"></i> Modifier
                                                        </a>
                                                        <button class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left" onclick="openDeleteDialog()">
                                                            <i class="ri-delete-bin-line mr-2"></i> Supprimer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-semibold mt-2 line-clamp-2">Formation des nouveaux bénévoles</h3>
                                    </div>
                                    <div class="p-4 pt-0">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                            <i class="ri-calendar-line h-4 w-4"></i>
                                            <span>25/07/2023</span>
                                            <span class="mx-1">•</span>
                                            <i class="ri-user-line h-4 w-4"></i>
                                            <span>Samira Tazi</span>
                                        </div>
                                        <span class="inline-flex items-center rounded-md border border-input px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 mb-3 font-medium">
                                            Événement
                                        </span>
                                        <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                                            Une session de formation pour les nouveaux bénévoles aura lieu le 15 août 2023. Inscrivez-vous dès maintenant.
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Formation
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Bénévoles
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4 pt-0 flex justify-between items-center border-t">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="ri-edit-line h-4 w-4"></i>
                                            <span>Brouillon</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3">
                                            Continuer l'édition
                                        </a>
                                    </div>
                                </div>

                                <!-- Publication Card 5 (Archivé) -->
                                <div class="bg-white rounded-lg border shadow-sm overflow-hidden hover:shadow-md transition-shadow opacity-80">
                                    <div class="p-4 pb-2">
                                        <div class="flex justify-between items-start">
                                            <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                                              Archivé
                                            </span>
                                            <div class="relative">
                                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0 action-btn" onclick="toggleDropdown(this)">
                                                    <span class="sr-only">Ouvrir le menu</span>
                                                    <i class="ri-more-2-fill h-4 w-4"></i>
                                                </button>
                                                <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                                    <div class="py-1">
                                                        <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-eye-line mr-2"></i> Voir les détails
                                                        </a>
                                                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="ri-edit-line mr-2"></i> Modifier
                                                        </a>
                                                        <button class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left" onclick="openDeleteDialog()">
                                                            <i class="ri-delete-bin-line mr-2"></i> Supprimer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-semibold mt-2 line-clamp-2">Mise à jour des protocoles sanitaires</h3>
                                    </div>
                                    <div class="p-4 pt-0">
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                            <i class="ri-calendar-line h-4 w-4"></i>
                                            <span>10/08/2023</span>
                                            <span class="mx-1">•</span>
                                            <i class="ri-user-line h-4 w-4"></i>
                                            <span>Dr. Mohammed Alaoui</span>
                                        </div>
                                        <span class="inline-flex items-center rounded-md border border-input px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 mb-3 font-medium">
                                            Annonce
                                        </span>
                                        <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                                            Suite aux nouvelles recommandations du ministère de la Santé, nos protocoles sanitaires ont été mis à jour.
                                        </p>
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Protocoles
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              Santé
                                            </span>
                                            <span class="inline-flex items-center rounded-md bg-secondary text-secondary-foreground px-2.5 py-0.5 text-xs">
                                              COVID-19
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-4 pt-0 flex justify-between items-center border-t">
                                        <div class="flex items-center gap-1 text-sm text-gray-500">
                                            <i class="ri-archive-line h-4 w-4"></i>
                                            <span>Archivé</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3">
                                            Voir les détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="flex items-center justify-between space-x-2 p-4 border-t">
                            <div class="text-sm text-gray-500">
                                Affichage de 1 à 5 sur 5 publications
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3 disabled:opacity-50">
                                    <i class="ri-arrow-left-s-line h-4 w-4"></i>
                                    <span class="sr-only">Page précédente</span>
                                </button>
                                <div class="text-sm">
                                    Page 1 sur 1
                                </div>
                                <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-8 px-3 disabled:opacity-50">
                                    <i class="ri-arrow-right-s-line h-4 w-4"></i>
                                    <span class="sr-only">Page suivante</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boîte de dialogue de confirmation de suppression (caché par défaut) -->
                <div class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50" id="deleteDialog">
                    <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold">Confirmer la suppression</h2>
                            <p class="text-sm text-gray-500 mt-2">
                                Êtes-vous sûr de vouloir supprimer cette publication ? Cette action est irréversible.
                            </p>
                        </div>
                        <div class="flex items-center justify-end gap-2 p-4 border-t">
                            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4" onclick="document.getElementById('deleteDialog').classList.add('hidden')">
                                Annuler
                            </button>
                            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-destructive text-destructive-foreground hover:bg-destructive/90 h-9 px-4">
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </main>
</div>

<script>
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.action-btn') && !event.target.closest('.dropdown')) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }
    });

    function toggleDropdown(button) {
        const allDropdowns = document.querySelectorAll('.dropdown');
        allDropdowns.forEach(dropdown => {
            if (dropdown !== button.nextElementSibling) {
                dropdown.classList.remove('show');
            }
        });

        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('show');

        event.stopPropagation();
    }

    function openDeleteDialog() {
        document.getElementById('deleteDialog').classList.remove('hidden');
    }
</script>
@endsection
