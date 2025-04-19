@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Détails de la Publication')

@section('content')
    <div class="p-8">
        <div class="flex items-center mb-6">
            <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-gray-600 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold">Détails de la Publication</h1>
                <p class="text-l font-regular text-gray-500">Visualiser les détails de la publication</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8 mb-8">
        <!-- Main Content -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            <i class="fas fa-edit mr-1.5"></i> Modifier
                        </a>
                        @if($post->is_archived)
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150">
                                    <i class="fas fa-undo mr-1.5"></i> Restaurer
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.archive', $post->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                                    <i class="fas fa-archive mr-1.5"></i> Archiver
                                </button>
                            </form>
                        @endif
                        <button onclick="openModal('deleteModal')" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                            <i class="fas fa-trash mr-1.5"></i> Supprimer
                        </button>
                    </div>
                </div>

                <div class="flex items-center mb-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->is_archived ? 'bg-gray-100 text-gray-800' : 'bg-green-100 text-green-800' }} mr-2">
                        {{ $post->is_archived ? 'Archivé' : 'Publié' }}
                    </span>
                    <span class="text-sm text-gray-500">Créé le {{ $post->created_at->format('d/m/Y H:i') }} • Modifié le {{ $post->updated_at->format('d/m/Y H:i') }}</span>
                </div>

                <div class="prose max-w-none">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Informations</h3>

                <div class="space-y-4">
                    <div>
                        <span class="text-xs text-gray-500 block">ID</span>
                        <p class="text-sm font-medium text-gray-900">{{ $post->id }}</p>
                    </div>

                    <div>
                        <span class="text-xs text-gray-500 block">Auteur</span>
                        <p class="text-sm font-medium text-gray-900">{{ $post->user->name ?? 'Admin' }}</p>
                    </div>

                    <div>
                        <span class="text-xs text-gray-500 block">Statut</span>
                        <p class="text-sm font-medium {{ $post->is_archived ? 'text-gray-600' : 'text-green-600' }}">
                            {{ $post->is_archived ? 'Archivé' : 'Publié' }}
                        </p>
                    </div>
                </div>
            </div>

            @if($post->image)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Image</h3>
                    <img src="{{ asset('storage/posts/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-md">
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Supprimer la publication</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Êtes-vous sûr de vouloir supprimer définitivement cette publication?
                    </p>
                </div>
                <div class="flex justify-center gap-4 mt-3 px-4 py-3">
                    <button onclick="closeModal('deleteModal')" class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none">
                        Annuler
                    </button>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
