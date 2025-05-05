@extends('User.layouts.Template')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 py-16 max-w-6xl">
            <!-- Header -->
            <div class="mb-16 text-center">
                <h1 class="font-serif text-3xl mb-3 leading-tight">Articles</h1>
                <div class="w-16 h-0.5 bg-red-200 mx-auto"></div>
            </div>

            <!-- Articles Grid -->
            @if($articles->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                    @foreach($articles as $article)
                        <div class="group bg-white rounded-md shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="aspect-[4/3] overflow-hidden mb-5 rounded-t-md">
                                @if($article->picture)
                                    <img
                                        src="{{ asset('storage/' . $article->picture) }}"
                                        alt="{{ $article->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    >
                                @else
                                    <div class="w-full h-full bg-gray-50 flex items-center justify-center">
                                        <span class="text-gray-300 text-xl font-serif">RUBI</span>
                                    </div>
                                @endif
                            </div>

                            <div class="px-5 pb-5">
                                <h2 class="font-serif text-lg mb-3 leading-tight group-hover:text-red-700 transition-colors overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $article->title }}
                                </h2>

                                <p class="text-gray-500 text-sm mb-4 leading-relaxed overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    {{ Str::limit(strip_tags($article->content), 100) }}
                                </p>

                                <div class="flex justify-between items-center">
                                    <a href="{{ route('articles.show', $article->id) }}" class="text-xs text-gray-900 border-b border-transparent hover:border-gray-900 transition-colors">
                                        Read article
                                    </a>

                                    <span class="text-xs text-gray-400">
                                        {{ $article->date ? $article->date->format('M d, Y') : $article->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-20 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-gray-500">No articles available at the moment.</p>
                </div>
            @endif

        </div>
    </div>
@endsection

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
