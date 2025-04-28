@extends('User.layouts.Template')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 py-12 max-w-6xl">
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Left Column - Featured Article (SMALLER) -->
                <div class="lg:col-span-5">
                    @if($articles->isNotEmpty())
                        <!-- Featured Article Image (REDUCED HEIGHT) -->
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

                        <!-- Featured Tag (SMALLER MARGIN) -->
                        <div class="uppercase text-gray-500 text-xs tracking-widest mb-2 font-medium">Featured article</div>

                        <!-- Featured Title (SMALLER FONT) -->
                        <h1 class="font-serif text-xl mb-3 leading-tight">
                            {{ $articles->first()->title }}
                        </h1>

                        <!-- Featured Excerpt (REDUCED LENGTH) -->
                        <p class="text-gray-600 mb-3 text-sm leading-relaxed">
                            {{ Str::limit(strip_tags($articles->first()->content), 120) }}
                        </p>

                        <!-- Read More Link -->
                        <a href="{{ route('articles.show', $articles->first()->id) }}" class="text-sm text-gray-900 hover:underline">
                            Read full article
                        </a>
                    @endif
                </div>

                <!-- Right Column - Article List -->
                <div class="lg:col-span-7">
                    <div class="space-y-12">
                        @foreach($articles->skip(1)->take(5) as $index => $article)
                            <!-- Article Item -->
                            <div class="grid grid-cols-12 gap-4 items-start">
                                <!-- Article Number -->
                                <div class="col-span-1">
                                    <span class="text-gray-400 font-serif text-xl">{{ sprintf('%02d', $index + 1) }}</span>
                                </div>

                                <!-- Article Content -->
                                <div class="col-span-8">
                                    <!-- Article Title -->
                                    <h2 class="font-serif text-lg mb-2 leading-tight">
                                        {{ $article->title }}
                                    </h2>

                                    <!-- Article Excerpt -->
                                    <p class="text-gray-600 text-sm mb-2 leading-relaxed">
                                        {{ Str::limit(strip_tags($article->content), 120) }}
                                    </p>

                                    <!-- Read More Link -->
                                    <a href="{{ route('articles.show', $article->id) }}" class="text-xs text-gray-900 hover:underline">
                                        Read more
                                    </a>
                                </div>

                                <!-- Article Thumbnail -->
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
                        <a href="#" class="inline-flex items-center text-gray-500 hover:text-gray-900">
                            <span class="mr-2">More articles</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $articles->onEachSide(1)->links() }}
            </div>

            <!-- Footer Info -->
            <div class="mt-20 pt-8 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                <div>
                    Contact us: <span class="text-gray-900">+33 (0)1 23 45 67 89</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>123 Blood Donation Street, 75000 Paris</span>
                </div>
            </div>
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

        /* Minimal Pagination */
        .pagination {
            @apply inline-flex;
        }

        .pagination > * {
            @apply px-3 py-1 text-xs text-gray-500 mx-1;
        }

        .pagination > .active {
            @apply text-gray-900 font-medium;
        }

        .pagination > *:hover:not(.active):not(.disabled) {
            @apply text-gray-900;
        }

        .pagination > .disabled {
            @apply opacity-50 cursor-not-allowed;
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
