@extends('User.layouts.aside')

@section('content')

    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6">
            <div class="mb-12">
                <h1 class="font-serif text-3xl mb-2 text-red-800">Mes commentaires</h1>
                <p class="text-gray-600 text-sm">Gérez vos interactions et suivez vos contributions</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
                    <p class="text-sm">{!! session('success') !!}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Stats Summary with Blood Theme -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-red-50 p-6 rounded-lg border border-red-100">
                    <div class="text-3xl font-serif mb-1 text-red-800">{{ $comments->count() }}</div>
                    <div class="text-xs uppercase tracking-wider text-red-600">Commentaires totaux</div>
                </div>
                <div class="bg-red-50 p-6 rounded-lg border border-red-100">
                    <div class="text-3xl font-serif mb-1 text-red-800">{{ $comments->unique('post_id')->count() }}</div>
                    <div class="text-xs uppercase tracking-wider text-red-600">Publications commentées</div>
                </div>
                <div class="bg-red-50 p-6 rounded-lg border border-red-100">
                    <div class="text-3xl font-serif mb-1 text-red-800">{{ $comments->max('created_at') ? $comments->max('created_at')->diffForHumans() : 'Aucun' }}</div>
                    <div class="text-xs uppercase tracking-wider text-red-600">Dernier commentaire</div>
                </div>
            </div>

            <!-- Filter and Sort Options -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
                <!-- Sort Options -->
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Trier par:</span>
                    <a href="" class="text-sm {{ request('sort', 'newest') == 'newest' ? 'text-red-700 font-medium' : 'text-gray-600 hover:text-red-700' }}">
                        Plus récents
                    </a>
                    <a href="" class="text-sm {{ request('sort') == 'oldest' ? 'text-red-700 font-medium' : 'text-gray-600 hover:text-red-700' }}">
                        Plus anciens
                    </a>
                </div>

                <!-- Search Box -->
                <form action="" method="GET" class="relative">
                    <input type="text"
                           name="search"
                           placeholder="Rechercher dans vos commentaires..."
                           value="{{ request('search') }}"
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Comments List -->
            @if($comments->count() > 0)
                <div class="space-y-6">
                    @foreach($comments as $comment)
                        <div class="bg-white border border-red-100 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row justify-between mb-4">
                                    <!-- Comment Info -->
                                    <div class="mb-4 md:mb-0">
                                        <div class="flex items-center mb-2">
                                            <svg class="w-4 h-4 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 21.5c-4.142 0-7.5-3.358-7.5-7.5 0-3.096 2.135-6.43 6.346-9.993.21-.177.518-.177.728 0C15.865 7.57 18 10.904 18 14c0 4.142-3.358 7.5-7.5 7.5z"/>
                                            </svg>
                                            <h3 class="font-medium text-red-800">Commentaire sur</h3>
                                        </div>
                                        <a href="{{ route('user.community.show', $comment->post_id) }}" class="font-serif text-lg text-gray-800 hover:text-red-700 transition-colors">
                                            {{ $comment->post->title ?? 'Publication #' . $comment->post_id }}
                                        </a>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $comment->created_at->format('d/m/Y à H:i') }}
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex space-x-3">
                                        <a href="" class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            <svg class="w-3 h-3 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Éditer
                                        </a>
                                        <form action="" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-300 text-xs font-medium rounded-md text-red-700 bg-white hover:bg-red-50">
                                                <svg class="w-3 h-3 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Comment Content -->
                                <div class="bg-gray-50 p-4 rounded-md border border-gray-100">
                                    <p class="text-gray-700 text-sm">{{ $comment->content }}</p>
                                </div>

                                <!-- Post Preview -->
                                <div class="mt-4 pt-4 border-t border-red-50">
                                    <div class="flex items-start">
                                        <!-- Post Author Avatar -->
                                        <div class="mr-3 flex-shrink-0">
                                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-medium text-xs">
                                                {{ strtoupper(substr($comment->post->user->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr($comment->post->user->last_name ?? 'U', 0, 1)) }}
                                            </div>
                                        </div>

                                        <!-- Post Preview Content -->
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 mb-1">
                                                En réponse à <span class="font-medium text-gray-700">{{ $comment->post->user->first_name ?? 'Utilisateur' }} {{ $comment->post->user->last_name ?? '' }}</span>
                                            </p>
                                            <p class="text-xs text-gray-600 line-clamp-2">
                                                {{ \Illuminate\Support\Str::limit($comment->post->content ?? 'Contenu non disponible', 100) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $comments->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 bg-red-50 rounded-lg border border-red-100">
                    <svg class="mx-auto h-12 w-12 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-red-800">Aucun commentaire trouvé</h3>
                    <p class="mt-1 text-sm text-red-600">Vous n'avez pas encore commenté de publications.</p>
                    <div class="mt-6">
                        <a href="{{ route('user.community.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Explorer les publications
                        </a>
                    </div>
                </div>
            @endif

            <!-- Blood-themed Footer -->
            <div class="mt-16 pt-8 border-t border-red-100">
                <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
                    <div class="mb-4 md:mb-0">
                        <span class="text-red-700 font-medium">Votre voix compte.</span> Partagez votre expérience avec la communauté.
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 21.5c-4.142 0-7.5-3.358-7.5-7.5 0-3.096 2.135-6.43 6.346-9.993.21-.177.518-.177.728 0C15.865 7.57 18 10.904 18 14c0 4.142-3.358 7.5-7.5 7.5z"/>
                        </svg>
                        <span>Ensemble, sauvons des vies</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Blood-themed Typography */
        .font-serif {
            font-family: 'Playfair Display', 'Times New Roman', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Line clamp for text truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Pagination styling */
        .pagination {
            @apply flex justify-center;
        }

        .pagination > * {
            @apply mx-1 px-3 py-1 text-sm rounded-md;
        }

        .pagination > .active {
            @apply bg-red-100 text-red-700;
        }

        .pagination > *:hover:not(.active):not(.disabled) {
            @apply bg-gray-100;
        }

        .pagination > .disabled {
            @apply opacity-50 cursor-not-allowed;
        }
    </style>
@endpush

