@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Détails de l\'article')

@section('content')
    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <div class="p-6">
            <!-- Fil d'Ariane et bouton modifier -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-2">
                    <a href="/admin/articles" class="inline-flex items-center justify-center rounded-md border border-gray-200 bg-white h-8 w-8 p-0">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </a>
                    <div class="text-sm">
                        <a href="/admin/articles" class="text-gray-600 hover:underline">Articles</a>
                        <span class="text-gray-400 mx-1">></span>
                        <span class="text-gray-800">Détails de l'article</span>
                    </div>
                </div>
                <a href="{{ route('articles.edit', $article->id) }}" class="inline-flex items-center justify-center rounded-md bg-black text-white px-4 py-2 text-sm font-medium">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier l'article
                </a>
            </div>

            <!-- Titre et date de publication -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-2">{{ $article->title }}</h1>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span>Publié le {{ $article->date->format('d/m/Y') }}</span>
                </div>
            </div>

            <!-- Contenu principal en deux colonnes -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Colonne de gauche -->
                <div class="flex flex-col">
                    <!-- Informations sur l'article -->
                    <div class="bg-white border border-gray-200 rounded-md p-6 mb-4">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-info-circle text-gray-500 mr-2"></i>
                            <h2 class="text-lg font-medium">Informations sur l'article</h2>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-spinner text-gray-400 mr-3"></i>
                                <span class="text-gray-600 w-32">Statut:</span>
                                <span class="{{ $article->status == 'published' ? 'text-green-600' : ($article->status == 'draft' ? 'text-yellow-600' : 'text-gray-600') }} font-medium">
                                    @if($article->status == 'published')Publié
                                        @elseif($article->status == 'draft')Brouillon
                                        @else Archivé
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center">
                                <i class="far fa-calendar-alt text-gray-400 mr-3"></i>
                                <span class="text-gray-600 w-32">Date de publication</span>
                                <span>{{ $article->date->format('d/m/Y') }}</span>
                            </div>

                            <div class="flex items-center">
                                <i class="far fa-clock text-gray-400 mr-3"></i>
                                <span class="text-gray-600 w-32">Créé le</span>
                                <span>{{ $article->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div class="flex items-center">
                                <i class="fas fa-pencil-alt text-gray-400 mr-3"></i>
                                <span class="text-gray-600 w-32">Modifié le</span>
                                <span>{{ $article->updated_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex gap-2">
                        @if($article->status != 'archived')
                            <form action="/admin/articles/{{ $article->id }}/archive" method="POST" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-archive mr-2"></i>
                                    Archiver
                                </button>
                            </form>
                        @else
                            <form action="/admin/articles/{{ $article->id }}/publish" method="POST" class="flex-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Publier
                                </button>
                            </form>
                        @endif


                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button class="flex-1 flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700" onclick="document.getElementById('deleteDialog').classList.add('show')">
                                    <i class="fas fa-trash mr-2"></i>
                                    Supprimer
                                </button>
                        </form>
                    </div>
                </div>

                <!-- Contenu de l'article -->
                <div class="bg-white border border-gray-200 rounded-md p-6 md:col-span-2">
                    <h2 class="text-xl font-bold mb-4">{{ $article->title }}</h2>

                    <div class="prose max-w-none">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Boîte de dialogue de confirmation de suppression -->
    <div class="dialog" id="deleteDialog">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Confirmer la suppression</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.
                </p>
            </div>
            <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm" onclick="document.getElementById('deleteDialog').classList.remove('show')">
                    Annuler
                </button>
                <form action="/admin/articles/{{ $article->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .dialog {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            align-items: center;
            justify-content: center;
        }

        .dialog.show {
            display: flex;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 12px;
        }
    </style>

    <script>
        // Fermer les dialogues en cliquant à l'extérieur
        document.querySelectorAll('.dialog').forEach(dialog => {
            dialog.addEventListener('click', (e) => {
                if (e.target === dialog) {
                    dialog.classList.remove('show');
                }
            });
        });
    </script>
@endsection
