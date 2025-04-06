@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Modifier l\'article')

@section('styles')
    <style>
        trix-editor {
            min-height: 300px;
            border-radius: 0.375rem;
            border-color: #e5e7eb;
            padding: 0.5rem;
        }

        trix-editor:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
@endsection

@section('content')
    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <div class="p-4 bg-gray-100 border-b border-gray-200">
            <h1 class="text-lg font-medium text-gray-500">Modifier un article</h1>
        </div>

        <div class="p-6">
            <!-- Fil d'Ariane -->
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-200 bg-white h-8 w-8 p-0">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div class="text-sm">
                    <a href="{{ route('articles.index') }}" class="text-gray-600 hover:underline">Articles</a>
                    <span class="text-gray-400 mx-1">></span>
                    <span class="text-gray-800">Modifier l'article</span>
                </div>
            </div>

            <!-- Titre et sous-titre -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-1">Modifier l'article</h1>
                <p class="text-sm text-gray-500">Modifiez les informations de l'article</p>
            </div>

            <!-- Formulaire d'article -->
            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-200 rounded-md p-6 mb-6">
                @csrf
                @method('PUT')
                <h2 class="text-lg font-medium mb-6">Informations de l'article</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Titre de l'article -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'article</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            placeholder="Écrivez le titre de l'article"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('title') border-red-500 @enderror"
                            value="{{ old('title', $article->title) }}"
                            required
                        >
                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select
                            id="status"
                            name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('status') border-red-500 @enderror"
                            required
                        >
                            <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Brouillon</option>
                            <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Publié</option>
                            <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archivé</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date de publication -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date de publication</label>
                        <input
                            type="date"
                            id="date"
                            name="date"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('date') border-red-500 @enderror"
                            value="{{ old('date', $article->date->format('Y-m-d')) }}"
                            required
                        >
                        @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image principale (picture) -->
                    <div>
                        <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Image principale</label>
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}" class="w-32 h-32 object-cover rounded-md">
                        </div>
                        <input
                            type="file"
                            id="picture"
                            name="picture"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('picture') border-red-500 @enderror"
                            accept="image/*"
                        >
                        <p class="text-xs text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle</p>
                        @error('picture')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contenu avec Trix Editor -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
                    <trix-editor input="content" class="trix-content border border-gray-300 rounded-md min-h-[300px] @error('content') border-red-500 @enderror"></trix-editor>
                    <p class="text-xs text-gray-500 mt-1">Vous pouvez insérer du texte et des images dans le contenu</p>
                    @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between">
                    <a href="{{ route('articles.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-black text-white rounded-md text-sm flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Trix Editor initialisé');

            // Configurer l'événement d'upload de fichier
            document.addEventListener('trix-attachment-add', function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment);
                }
            });
        });

        function uploadFileAttachment(attachment) {
            console.log('Début upload fichier:', attachment.file.name);

            // Récupérer le token CSRF depuis la balise meta
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const formData = new FormData();
            formData.append('file', attachment.file);
            formData.append('_token', token);

            // Ajouter l'ID de l'article pour organiser les fichiers par article
            formData.append('article_id', '{{ $article->id }}');

            // Afficher la progression de l'upload
            attachment.setUploadProgress(0);

            fetch('/admin/upload-trix-attachment', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                }
            })
                .then(response => {
                    console.log('Statut de la réponse:', response.status);
                    if (!response.ok) {
                        throw new Error('Erreur réseau: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Données reçues:', data);
                    if (data.url) {
                        console.log('URL de l\'image:', data.url);
                        attachment.setAttributes({
                            url: data.url,
                            href: data.url
                        });
                    } else {
                        throw new Error('URL non trouvée dans la réponse');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de l\'upload:', error);
                    attachment.remove();
                })
                .finally(() => {
                    // Terminer la progression
                    attachment.setUploadProgress(100);
                });
        }
    </script>
@endsection
