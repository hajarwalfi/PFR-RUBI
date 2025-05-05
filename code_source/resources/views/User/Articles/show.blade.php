@extends('User.layouts.Template')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-8 max-w-3xl">
            <div class="mb-8">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-900 text-sm">
                    <i class="fas fa-arrow-left mr-2 text-sm"></i>
                    Articles
                </a>
            </div>

            <div class="mb-6">
                <!-- Métadonnées de l'article -->
                <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                    <div>{{ $article->date->format('d M Y') }}</div>
                    <div class="flex items-center">
                        <i class="fas fa-eye mr-1 text-xs"></i>
                        {{ $article->views ?? 0 }} vues
                    </div>
                </div>

                <h1 class="font-serif text-2xl md:text-3xl mb-6 leading-tight">{{ $article->title }}</h1>
            </div>

            <div class="article-content font-light leading-relaxed prose prose-sm max-w-none">
                {!! $article->content !!}
            </div>
        </div>
    </div>
@endsection
