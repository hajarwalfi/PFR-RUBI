@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Modifier Publication')

@section('content')
    <div class="p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-gray-600 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold">Modifier la Publication</h1>
                <p class="text-l font-regular text-gray-500">Modifier les informations de la publication</p>
            </div>
        </div>
    </div>

    <div class="px-8 mb-8">
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold mb-1">Informations de la publication</h2>
                <p class="text-gray-500 text-sm">Modifiez les informations de la publication</p>
            </div>

            <div class="p-6">
                @if($errors->any())
                    <div class="rounded-md bg-red-50 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Veuillez corriger les erreurs suivantes:
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Titre <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('title', $post->title) }}" required>
                            </div>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">
                                Contenu <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <textarea id="content" name="content" rows="8" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md" required>{{ old('content', $post->content) }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Image
                            </label>
                            @if($post->image)
                                <div class="mt-2 mb-4">
                                    <img src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ $post->title }}" class="h-32 w-auto object-cover rounded-md">
                                    <p class="mt-1 text-sm text-gray-500">Image actuelle</p>
                                </div>
                            @endif
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none">
                                            <span>Télécharger une nouvelle image</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">ou glisser-déposer</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF jusqu'à 2MB
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('posts.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <i class="fas fa-save mr-2"></i> Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('content');

            // Show file name when selected
            const fileInput = document.getElementById('image');
            if (fileInput) {
                fileInput.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name;
                    if (fileName) {
                        const fileNameDisplay = document.createElement('p');
                        fileNameDisplay.classList.add('mt-2', 'text-sm', 'text-gray-600');
                        fileNameDisplay.textContent = `Fichier sélectionné: ${fileName}`;

                        const existingText = this.parentElement.parentElement.querySelector('p.mt-2');
                        if (existingText) {
                            existingText.remove();
                        }

                        this.parentElement.parentElement.appendChild(fileNameDisplay);
                    }
                });
            }
        });
    </script>
@endsection
