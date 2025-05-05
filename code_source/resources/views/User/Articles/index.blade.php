@extends('User.layouts.Template')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 py-12 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                @if($articles->isNotEmpty())
                    <!-- Featured Article (First Article) -->
                    <div class="lg:col-span-5">
                        <div class="mb-4 relative">
                            @if($articles->first()->picture)
                                <img
                                    src="{{ asset('storage/' . $articles->first()->picture) }}"
                                    alt="{{ $articles->first()->title }}"
                                    class="w-full h-[320px] object-cover"
                                >
                            @else
                                <div class="w-full h-[320px] bg-gray-100"></div>
                            @endif
                        </div>

                        <div class="uppercase text-gray-500 text-xs tracking-widest mb-2 font-medium">Featured article</div>

                        <h1 class="font-serif text-xl mb-3 leading-tight">
                            {{ $articles->first()->title }}
                        </h1>

                        <p class="text-gray-600 mb-3 text-sm leading-relaxed">
                            {{ Str::limit(strip_tags($articles->first()->content), 120) }}
                        </p>

                        <a href="{{ route('articles.show', $articles->first()->id) }}" class="text-sm text-gray-900 hover:underline">
                            Read full article
                        </a>
                    </div>

                    <!-- List of Articles (Next 3 Articles) -->
                    <div class="lg:col-span-7">
                        <div class="space-y-12">
                            @foreach($articles->skip(1)->take(3) as $index => $article)
                                <div class="grid grid-cols-12 gap-4 items-start">
                                    <div class="col-span-1">
                                        <span class="text-gray-400 font-serif text-xl">{{ sprintf('%02d', $index + 1) }}</span>
                                    </div>

                                    <div class="col-span-8">
                                        <h2 class="font-serif text-lg mb-2 leading-tight">
                                            {{ $article->title }}
                                        </h2>

                                        <p class="text-gray-600 text-sm mb-2 leading-relaxed">
                                            {{ Str::limit(strip_tags($article->content), 120) }}
                                        </p>

                                        <!-- Read More Link -->
                                        <a href="{{ route('articles.show', $article->id) }}" class="text-xs text-gray-900 hover:underline">
                                            Read more
                                        </a>
                                    </div>

                                    <div class="col-span-3">
                                        @if($article->picture)
                                            <img
                                                src="{{ asset('storage/' . $article->picture) }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-20 object-cover"
                                            >
                                        @else
                                            <div class="w-full h-20 bg-gray-100"></div>
                                        @endif
                                    </div>
                                </div>

                                @if(!$loop->last)
                                    <div class="border-t border-gray-100"></div>
                                @endif
                            @endforeach
                        </div>

                        <!-- More Articles Button -->
                        <div class="mt-12 text-center">
                            <a href="{{ route('articles.more') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <span>View All Articles</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="lg:col-span-12 text-center py-12">
                        <p class="text-gray-500">No articles available at the moment.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:wght@400;500;600&display=swap';
            document.head.appendChild(link);
        });
    </script>
@endpush
