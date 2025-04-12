@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Article Details')

@section('content')
    <main class="flex-1">
        <div class="flex-1">
            <!-- Navigation -->
            <div class="p-4 flex justify-between items-center border-b border-gray-200">
                <div class="flex items-center space-x-2 text-xs">
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                        <i class="fas fa-arrow-left h-5 w-5"></i>
                    </a>
                    <div class="flex items-center text-gray-500">
                        <a href="{{ route('articles.index') }}" class="hover:text-black hover:underline">Articles</a>
                        <span class="mx-2">&gt;</span>
                        <a href="{{ route('articles.show', $article->id) }}" class="hover:text-black hover:underline">{{ $article->title }}</a>
                    </div>
                </div>

                <a href="{{ route('articles.edit', $article->id) }}" class="bg-black text-white px-4 py-2 rounded-md flex items-center space-x-2">
                    <i class="fas fa-edit h-5 w-5"></i>
                    <span>Edit Article</span>
                </a>
            </div>

            <!-- Article Information -->
            <div class="p-6">
                <!-- Title and publication date -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-1">{{ $article->title }}</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-xs">
                            <i class="far fa-calendar-alt h-3 w-5 text-gray-500 mr-1"></i>
                            <span class="text-gray-600 ">Updated at {{ $article->updated_at->format('d/m/Y') }}</span>
                        </div>
                        <span class="{{ $article->status == 'published' ? 'bg-green-100 text-green-800' : ($article->status == 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }} px-3 py-1 rounded-full text-sm">
                            @if($article->status == 'published')Published
                            @elseif($article->status == 'draft')Draft
                            @else Archived
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Information sections with custom grid -->
                <div class="grid grid-cols-12 gap-6">
                    <!-- Article Information -->
                    <div class="col-span-12 md:col-span-4 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Section title -->
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <i class="fas fa-info-circle h-5 w-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">Article Information</h3>
                                <p class="text-xs text-gray-500">Details and metadata</p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-spinner h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Status</span>
                            </div>
                            <p class="font-medium text-sm pl-7 {{ $article->status == 'published' ? 'text-green-600' : ($article->status == 'draft' ? 'text-yellow-600' : 'text-gray-600') }}">
                                @if($article->status == 'published')Published
                                @elseif($article->status == 'draft')Draft
                                @else Archived
                                @endif
                            </p>
                        </div>

                        <!-- Publication Date -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="far fa-calendar-alt h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Publication Date</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $article->date->format('d/m/Y') }}</p>
                        </div>

                        <!-- Created Date -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="far fa-clock h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Created on</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $article->created_at->format('d/m/Y') }}</p>
                        </div>

                        <!-- Modified Date -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-pencil-alt h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Modified on</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">{{ $article->updated_at->format('d/m/Y') }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-4 space-y-2">
                            @if($article->status != 'archived')
                                <form action="{{ route('articles.archive', $article->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-archive mr-2"></i>
                                        Archive
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('articles.publish', $article->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Publish
                                    </button>
                                </form>
                            @endif

                            <button class="w-full flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700" onclick="document.getElementById('deleteDialog').classList.add('show')">
                                <i class="fas fa-trash mr-2"></i>
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="col-span-12 md:col-span-8 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Section title -->
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <i class="fas fa-file-alt h-5 w-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">Article Content</h3>
                                <p class="text-xs text-gray-500">Full text of the article</p>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="prose max-w-none text-sm">
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Dialog -->
    <div class="dialog" id="deleteDialog">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Confirm Deletion</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Are you sure you want to delete this article? This action cannot be undone.
                </p>
            </div>
            <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm" onclick="document.getElementById('deleteDialog').classList.remove('show')">
                    Cancel
                </button>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .dialog {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            align-items: center;
            justify-content: center;
        }

        .dialog.show {
            display: flex;
        }
    </style>

    <script>
        // Close dialogs when clicking outside
        document.querySelectorAll('.dialog').forEach(dialog => {
            dialog.addEventListener('click', (e) => {
                if (e.target === dialog) {
                    dialog.classList.remove('show');
                }
            });
        });
    </script>
@endsection
