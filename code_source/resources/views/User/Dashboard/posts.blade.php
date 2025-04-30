@extends('User.layouts.aside')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 py-12 max-w-6xl">
            <!-- Header Section -->
            <div class="mb-12">
                <h1 class="font-serif text-3xl mb-2">Mes publications</h1>
                <p class="text-gray-500 text-sm">Gérez vos publications et suivez leur statut</p>
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

            <!-- Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-serif mb-1">{{ $posts->count() }}</div>
                    <div class="text-xs uppercase tracking-wider text-gray-500">Publications totales</div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-serif mb-1">{{ $posts->where('status', 'approved')->count() }}</div>
                    <div class="text-xs uppercase tracking-wider text-gray-500">Publications approuvées</div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-serif mb-1">{{ $posts->where('status', 'pending')->count() }}</div>
                    <div class="text-xs uppercase tracking-wider text-gray-500">En attente</div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="text-3xl font-serif mb-1">{{ $posts->sum('views') }}</div>
                    <div class="text-xs uppercase tracking-wider text-gray-500">Vues totales</div>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="border-b border-gray-200 mb-8">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <a href=""
                       class="{{ !request()->has('status') ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Tous
                    </a>
                    <a href=""
                       class="{{ request('status') == 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        En attente
                    </a>
                    <a href=""
                       class="{{ request('status') == 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Approuvés
                    </a>
                    <a href=""
                       class="{{ request('status') == 'rejected' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Rejetés
                    </a>
                </nav>
            </div>

            <!-- Create New Post Button -->
            <div class="flex justify-end mb-8">
                <a href="" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Nouvelle publication
                </a>
            </div>

            <!-- Posts List -->
            @if($posts->count() > 0)
                <div class="space-y-1">
                    @foreach($posts as $index => $post)
                        <div class="border-b border-gray-100 py-6 {{ $loop->first ? 'border-t' : '' }}">
                            <div class="grid grid-cols-12 gap-6 items-start">
                                <!-- Post Number -->
                                <div class="col-span-1 hidden md:block">
                                    <span class="text-gray-300 font-serif text-xl">{{ sprintf('%02d', $index + 1) }}</span>
                                </div>

                                <!-- Post Content -->
                                <div class="col-span-12 md:col-span-8">
                                    <!-- Status Badge -->
                                    <div class="mb-2">
                                        @if($post->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                        @elseif($post->status == 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Approuvé
                                        </span>
                                        @elseif($post->status == 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Rejeté
                                        </span>
                                        @endif
                                    </div>

                                    <!-- Post Title -->
                                    <h2 class="font-serif text-xl mb-2 leading-tight">
                                        @if($post->title)
                                            {{ $post->title }}
                                        @else
                                            <span class="text-gray-400 italic">Sans titre</span>
                                        @endif
                                    </h2>

                                    <!-- Post Excerpt -->
                                    <p class="text-gray-600 text-sm mb-3 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit($post->content, 120) }}
                                    </p>

                                    <!-- Post Meta -->
                                    <div class="flex items-center text-xs text-gray-500 mb-4">
                                        <span>{{ $post->created_at->format('d/m/Y') }}</span>

                                        @if($post->views > 0)
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ $post->views }}
                                        </span>
                                        @endif

                                        @if($post->comments->count() > 0)
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ $post->comments->count() }}
                                        </span>
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex space-x-3">
                                        @if($post->status == 'approved')
                                            <a href="" class="text-xs font-medium text-gray-700 hover:text-gray-900">
                                                Voir
                                            </a>
                                            <a href="" class="text-xs font-medium text-gray-700 hover:text-gray-900">
                                                Éditer
                                            </a>
                                        @endif
                                        <form action="" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-medium text-red-600 hover:text-red-800">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Post Media -->
                                <div class="col-span-12 md:col-span-3">
                                    @if($post->media->count() > 0)
                                        @if($post->media->first()->type == 'image')
                                            <img src="{{ asset('storage/' . $post->media->first()->path) }}"
                                                 alt="Media"
                                                 class="w-full h-24 object-cover rounded-md">
                                        @elseif($post->media->first()->type == 'video')
                                            <div class="w-full h-24 bg-gray-100 rounded-md flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                        @endif

                                        @if($post->media->count() > 1)
                                            <div class="mt-2 text-xs text-gray-500">
                                                +{{ $post->media->count() - 1 }} autres médias
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-full h-24 bg-gray-50 rounded-md flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune publication trouvée</h3>
                    <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore créé de publications avec ce statut.</p>
                    <div class="mt-6">
                        <a href="" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Créer une publication
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Elegant Typography */
        .font-serif {
            font-family: 'Playfair Display', 'Times New Roman', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Add web fonts
        document.addEventListener('DOMContentLoaded', function() {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:wght@400;500;600&display=swap';
            document.head.appendChild(link);
        });
    </script>
@endpush
