@extends('User.layouts.Template')

@section('title') RUBI - Modifier un post @endsection

@section('content')
    <div class="bg-white min-h-screen py-10">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Bouton retour -->
            <div class="mb-8">
                <a href="{{ route('user.community.show', $post->id) }}" class="inline-flex items-center text-sm text-gray-500 hover:text-red-500 transition-colors">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Retour au post
                </a>
            </div>

            <!-- Notifications -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-3 text-sm text-green-700">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-checkbox-circle-line text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{!! session('success') !!}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-3 text-sm text-red-700">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-error-warning-line text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Formulaire d'édition -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 border-b border-gray-50">
                    <h1 class="text-lg font-medium text-gray-800">Modifier votre post</h1>
                </div>

                <div class="p-5">
                    <form action="{{ route('user.community.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <!-- Titre -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre (optionnel)</label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    value="{{ old('title', $post->title) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500"
                                    placeholder="Ajoutez un titre à votre post"
                                >
                                @error('title')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Contenu -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                                <textarea
                                    name="content"
                                    id="content"
                                    rows="6"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 resize-none"
                                    placeholder="Partagez votre expérience..."
                                    required
                                >{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Média existants -->
                            @if($post->media && $post->media->count() > 0)
                                <div>
                                    <p class="block text-sm font-medium text-gray-700 mb-2">Média existants</p>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                        @foreach($post->media as $media)
                                            <div class="relative border border-gray-200 rounded-md overflow-hidden">
                                                @if(isset($media['type']) && $media['type'] == 'image')
                                                    <img src="{{ Storage::url($media['path']) }}" alt="Media" class="w-full h-24 object-cover">
                                                @elseif(isset($media['type']) && $media['type'] == 'video')
                                                    <video class="w-full h-24 object-cover">
                                                        <source src="{{ Storage::url($media['path']) }}" type="video/mp4">
                                                    </video>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">
                                        Note: Les médias ne peuvent pas être modifiés. Pour changer les médias, veuillez créer un nouveau post.
                                    </p>
                                </div>
                            @endif

                            <!-- Boutons d'action -->
                            <div class="flex justify-end space-x-3 pt-4">
                                <a href="{{ route('user.community.show', $post->id) }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm rounded-md hover:bg-gray-200 transition-colors">
                                    Annuler
                                </a>
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded-md hover:bg-red-600 transition-colors">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Note d'information -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-700">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ri-information-line text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p>Après modification, votre post sera à nouveau soumis à modération avant d'être visible par la communauté.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
