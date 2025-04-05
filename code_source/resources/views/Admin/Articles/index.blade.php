@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Articles')

@section('content')
    <main class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Articles</h1>
            <p class="text-sm text-gray-500">Gérez les publications officielles dans l'application RUBI</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total Articles -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Total Articles</h2>
                    <div class="text-gray-500">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="text-2xl font-bold">{{ $stats['total'] }}</div>
                <p class="text-xs text-gray-500">Tous les articles enregistrés</p>
            </div>

            <!-- Publiés -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Publiés</h2>
                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                    {{ $stats['published'] }}
                </span>
                </div>
                <div class="text-2xl font-bold">{{ $stats['published_percentage'] }} %</div>
                <p class="text-xs text-gray-500">Publications actives</p>
            </div>

            <!-- Brouillons -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Brouillons</h2>
                    <span class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                    {{ $stats['draft'] }}
                </span>
                </div>
                <div class="text-2xl font-bold">{{ $stats['draft_percentage'] }} %</div>
                <p class="text-xs text-gray-500">En cours de rédaction</p>
            </div>

            <!-- Archivés -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium">Archivés</h2>
                    <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                    {{ $stats['archived'] }}
                </span>
                </div>
                <div class="text-2xl font-bold">{{ $stats['archived_percentage'] }} %</div>
                <p class="text-xs text-gray-500">Publications inactives</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg border border-gray-200 mb-6">
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold">Gestion des articles</h2>
                        <p class="text-sm text-gray-500">Consultez et gérez les articles enregistrés dans l'application RUBI</p>
                    </div>
                    <div>
                        <a href="/admin/articles/create" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-blue-600 text-white hover:bg-blue-700 h-9 px-3">
                            <i class="fas fa-plus mr-2"></i>
                            Ajouter un article
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <form action="/admin/articles" method="GET" class="relative w-full sm:w-64">
                    <i class="fas fa-search absolute left-2.5 top-2.5 h-4 w-4 text-gray-500"></i>
                    <input
                        type="search"
                        name="search"
                        placeholder="Rechercher un article..."
                        value="{{ request('search') }}"
                        class="flex h-10 w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 pl-8"
                    />
                </form>
                <div class="flex gap-2">
                    <a href="/admin/articles" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4 py-2 {{ !request('status') ? 'bg-gray-100' : '' }}">
                        Tous
                    </a>
                    <a href="/admin/articles?status=published" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4 py-2 {{ request('status') == 'published' ? 'bg-gray-100' : '' }}">
                        Publiés
                    </a>
                    <a href="/admin/articles?status=draft" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4 py-2 {{ request('status') == 'draft' ? 'bg-gray-100' : '' }}">
                        Brouillons
                    </a>
                    <a href="/admin/articles?status=archived" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4 py-2 {{ request('status') == 'archived' ? 'bg-gray-100' : '' }}">
                        Archivés
                    </a>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($articles as $article)
                        <!-- Article Card -->
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="p-4 pb-2">
                                <div class="flex justify-between items-start">
                                    @if($article->status == 'published')
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                Publié
                            </span>
                                    @elseif($article->status == 'draft')
                                        <span class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                                Brouillon
                            </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-50 px-2.5 py-0.5 text-xs font-semibold text-gray-700">
                                Archivé
                            </span>
                                    @endif
                                    <div class="relative">
                                        <button class="text-gray-500 hover:text-gray-700 action-btn p-1" onclick="toggleDropdown(this)">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown w-48 bg-white rounded-md shadow-lg border border-gray-200">
                                            <div class="py-1">
                                                <div class="px-4 py-2 text-base font-medium border-b border-gray-200">Actions</div>
                                                <a href="{{ route('articles.show', $article->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-eye mr-2"></i> Voir les détails
                                                </a>
                                                <a href="/admin/articles/{{ $article->id }}/edit" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-edit mr-2"></i> Modifier
                                                </a>
                                                <button class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left" onclick="openDeleteDialog('{{ $article->id }}')">
                                                    <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="text-lg font-semibold mt-2">{{ $article->title }}</h3>
                            </div>
                            <div class="p-4 pt-0">
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                    <i class="fas fa-calendar-alt h-4 w-4"></i>
                                    <span>{{ $article->date->format('d/m/Y') }}</span>
                                </div>
                                <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                                    {{ Str::limit(strip_tags($article->content), 150) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 p-8 text-center">
                            <p class="text-gray-500">Aucun article trouvé.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between p-4 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    @if($articles->count() > 0)
                        @if($articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            Affichage de {{ $articles->firstItem() }} à {{ $articles->lastItem() }} sur {{ $articles->total() }} articles
                        @else
                            Affichage de {{ $articles->count() }} article(s)
                        @endif
                    @else
                        Aucun article trouvé
                    @endif
                </div>
                @if($articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="flex items-center space-x-2">
                        @if($articles->onFirstPage())
                            <button disabled class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-8 w-8 p-0 opacity-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $articles->previousPageUrl() }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-8 w-8 p-0">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        <span class="text-sm">{{ $articles->currentPage() }} sur {{ $articles->lastPage() }}</span>

                        @if($articles->hasMorePages())
                            <a href="{{ $articles->nextPageUrl() }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-8 w-8 p-0">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <button disabled class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-8 w-8 p-0 opacity-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Delete Confirmation Dialog -->
        <div class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50" id="deleteDialog">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
                <div class="p-6">
                    <h2 class="text-lg font-semibold">Confirmer la suppression</h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.
                    </p>
                </div>
                <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                    <button class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-gray-200 bg-white hover:bg-gray-50 h-9 px-4" onclick="document.getElementById('deleteDialog').classList.add('hidden')">
                        Annuler
                    </button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-red-600 text-white hover:bg-red-700 h-9 px-4">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <style>
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 10;
        }

        .dropdown.show {
            display: block;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
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

        function openDeleteDialog(id) {
            document.getElementById('deleteForm').action = `/admin/articles/${id}`;
            document.getElementById('deleteDialog').classList.remove('hidden');
        }
    </script>
@endsection
