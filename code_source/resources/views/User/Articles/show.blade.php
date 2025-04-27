@extends('User.layouts.Template')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 py-12 max-w-4xl">
            <!-- Navigation discrète -->
            <div class="mb-12">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-900 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour aux articles
                </a>
            </div>

            <!-- En-tête de l'article -->
            <div class="mb-8">
                <!-- Métadonnées de l'article -->
                <div class="flex items-center justify-between text-xs text-gray-500 mb-6">
                    <div>{{ $article->date->format('d M Y') }}</div>
                    <div class="flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ $article->views ?? 0 }} vues
                    </div>
                </div>

                <!-- Titre de l'article -->
                <h1 class="font-serif text-3xl md:text-4xl mb-8 leading-tight">{{ $article->title }}</h1>
            </div>

            <!-- Image principale de l'article -->
            @if($article->picture)
                <div class="mb-10">
                    <img
                        src="{{ asset('storage/' . $article->picture) }}"
                        alt="{{ $article->title }}"
                        class="w-full h-auto object-cover"
                    >
                </div>
            @endif

            <!-- Contenu de l'article -->
            <div class="article-content font-light leading-relaxed">
                {!! $article->content !!}
            </div>

            <!-- Séparateur élégant -->
            <div class="my-12 flex items-center">
                <div class="flex-grow border-t border-gray-200"></div>
                <div class="mx-4">
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 8 8">
                        <circle cx="4" cy="4" r="3" />
                    </svg>
                </div>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <!-- Section de partage minimaliste -->
            <div class="flex justify-center space-x-6">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="text-gray-400 hover:text-gray-900">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                    </svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" target="_blank" class="text-gray-400 hover:text-gray-900">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                    </svg>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}" target="_blank" class="text-gray-400 hover:text-gray-900">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
                <a href="mailto:?subject={{ urlencode($article->title) }}&body={{ urlencode(request()->url()) }}" class="text-gray-400 hover:text-gray-900">
                    <span class="sr-only">Email</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </a>
            </div>

            <!-- Articles connexes -->
            <div class="mt-16 pt-12 border-t border-gray-100">
                <h3 class="font-serif text-xl mb-8">Articles connexes</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Vous pouvez ajouter ici une boucle pour afficher des articles connexes -->
                    <div class="flex items-start">
                        <span class="text-gray-300 font-serif text-xl mr-4">01</span>
                        <div>
                            <h4 class="font-serif text-base mb-2">Titre d'un article connexe</h4>
                            <a href="#" class="text-xs text-gray-900 hover:underline">Lire l'article</a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <span class="text-gray-300 font-serif text-xl mr-4">02</span>
                        <div>
                            <h4 class="font-serif text-base mb-2">Titre d'un autre article connexe</h4>
                            <a href="#" class="text-xs text-gray-900 hover:underline">Lire l'article</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="mt-20 pt-8 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                <div>
                    Pour nous contacter: <span class="text-gray-900">+33 (0)1 23 45 67 89</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>123 Rue du Don de Sang, 75000 Paris</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Typographie élégante */
        .font-serif {
            font-family: 'Playfair Display', 'Times New Roman', serif;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        /* Styles pour le contenu de l'article */
        .article-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #333;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
        }

        .article-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .article-content ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .article-content ol {
            list-style-type: decimal;
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-content a {
            color: #333;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 2px;
        }

        .article-content blockquote {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            border-left: 2px solid #333;
            padding-left: 1.5rem;
            margin-left: 0;
            margin-right: 0;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .article-content img {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Styles pour les images dans le contenu */
        .article-content img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Add web fonts
        document.addEventListener('DOMContentLoaded', function() {
            // You can add Google Fonts here if needed
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:wght@400;500;600&display=swap';
            document.head.appendChild(link);
        });
    </script>
@endpush
