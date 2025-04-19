@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Publications Archivées')

@section('content')
    <div class="p-8">
        <h1 class="text-3xl font-bold">Publications Archivées</h1>
        <p class="text-l font-regular text-gray-500">Gérer les publications archivées de l'application RUBI</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 mb-8">
        <!-- Total Archived -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Total Archivées</h2>
                <div class="p-2 rounded-full">
                    <i class="fas fa-archive text-gray-600"></i>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">{{ count($archivedPosts) }}</div>
            <div class="text-gray-500 text-xs">Publications archivées</div>
        </div>

        <!-- Recently Archived -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Récemment Archivées</h2>
                <div class="px-2 py-0.5 rounded-full bg-blue-100">
                    <span class="text-blue-600 font-semibold">
                        @php
                            $recentCount = $archivedPosts->filter(function($post) {
                                return $post->updated_at >= now()->subDays(30);
                            })->count();
                        @endphp
                        {{ $recentCount }}
                    </span>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">{{ $recentCount }}</div>
            <div class="text-gray-500 text-xs">Derniers 30 jours</div>
        </div>

        <!-- Active Publications -->
        <div class="bg-white rounded-lg border border-gray-200 p-3 px-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="font-semibold text-sm">Publications Actives</h2>
                <div class="px-2 py-0.5 rounded-full bg-green-100">
                    <span class="text-green-600 font-semibold">{{ $activeCount ?? 0 }}</span>
                </div>
            </div>
            <div class="text-2xl font-semibold mb-1">
                <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">Voir toutes</a>
            </div>
            <div class="text-gray-500 text-xs">Publications actives</div>
        </div>
    </div>

    <!-- Publication Management Section -->
    <div class="bg-white rounded-lg border border-gray-200 mx-8 mb-8">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold mb-1">Publications Archivées</h2>
            <p class="text-gray-500 text-sm">Visualiser et gérer les publications archivées de l'application RUBI</p>
        </div>

        <!-- Search and Filters -->
        <div class="p-4 border-b bg-gray-50 border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
            <form action="{{ route('posts.archived') }}" method="GET" class="w-full md:w-auto">
                <div class="relative w-full bg-white md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une publication archivée..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full md:w-80 text-sm">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </form>
            <div class="flex gap-2">
                <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Retour aux Publications
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mx-4 mt-4 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                <tr class="text-left border-b border-gray-200">
                    <th class="px-6 py-3 font-medium text-gray-600">ID</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Image</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Titre</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Date d'archivage</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Statut</th>
                    <th class="px-6 py-3 font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($archivedPosts as $post)
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">{{ $post->id }}</td>
                        <td class="px-6 py-4">
                            @if($post->image)
                                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ $post->title }}" class="h-10 w-10 rounded-md object-cover">
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Pas d'image
                                    </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $post->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-500">{{ $post->updated_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                    Archivé
                                </span>
                        </td>
                        <td class="px-6 text-center py-4 relative">
                            <button class="text-gray-500 hover:text-gray-700 action-btn" onclick="toggleDropdown(this)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                <div class="py-1">
                                    <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                    <a href="{{ route('posts.show', $post->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="far fa-eye mr-2"></i> Voir
                                    </a>
                                    <form action="{{ route('posts.restore', $post->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir restaurer cette publication?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="flex items-center px-4 py-2 text-sm text-green-600 hover:bg-gray-100 w-full text-left">
                                            <i class="far fa-undo mr-2"></i> Restaurer
                                        </button>
                                    </form>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left">
                                            <i class="far fa-trash-alt mr-2"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucune publication archivée trouvée</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 flex justify-end items-center border-t border-gray-200">
            {{ $archivedPosts->links() }}
        </div>
    </div>

    <style>
        .dropdown {
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 10;
            display: none;
        }
        .dropdown.show {
            display: block;
        }
    </style>

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
    </script>
@endsection
