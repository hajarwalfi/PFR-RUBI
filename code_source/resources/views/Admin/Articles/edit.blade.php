@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Edit Article')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <style>
        trix-editor {
            min-height: 300px;
            border-radius: 0.375rem;
            border-color: #e5e7eb;
            padding: 0.5rem;
        }

        trix-editor:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
@endsection

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
                        <span class="mx-2">&gt;</span>
                        <span class="text-gray-800">Edit</span>
                    </div>
                </div>
            </div>

            <!-- Article Information -->
            <div class="p-6">
                <!-- Title and subtitle -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-1">Edit Article</h2>
                    <p class="text-sm text-gray-500">Update article information and content</p>
                </div>

                <!-- Form -->
                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-12 gap-6">
                        <!-- Article Form -->
                        <div class="col-span-12 md:col-span-8 border border-gray-200 rounded-lg overflow-hidden">
                            <!-- Section title -->
                            <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <i class="fas fa-file-alt h-5 w-5"></i>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold">Article Content</h3>
                                    <p class="text-xs text-gray-500">Edit the article's main content</p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Article Title</label>
                                    <input
                                        type="text"
                                        id="title"
                                        name="title"
                                        placeholder="Enter article title"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('title') border-red-500 @enderror"
                                        value="{{ old('title', $article->title) }}"
                                        required
                                    >
                                    @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Content with Trix Editor -->
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                    <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
                                    <trix-editor input="content" class="trix-content border border-gray-300 rounded-md min-h-[300px] @error('content') border-red-500 @enderror"></trix-editor>
                                    <p class="text-xs text-gray-500 mt-1">You can insert text and images in the content</p>
                                    @error('content')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Article Settings -->
                        <div class="col-span-12 md:col-span-4 border border-gray-200 rounded-lg overflow-hidden">
                            <!-- Section title -->
                            <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <i class="fas fa-cog h-5 w-5"></i>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold">Article Settings</h3>
                                    <p class="text-xs text-gray-500">Configure article properties</p>
                                </div>
                            </div>

                            <!-- Settings -->
                            <div class="p-4 space-y-4">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select
                                        id="status"
                                        name="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('status') border-red-500 @enderror"
                                        required
                                    >
                                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Publication Date -->
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Publication Date</label>
                                    <input
                                        type="date"
                                        id="date"
                                        name="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('date') border-red-500 @enderror"
                                        value="{{ old('date', $article->date->format('Y-m-d')) }}"
                                        required
                                    >
                                    @error('date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Main Image -->
                                <div>
                                    <label for="picture" class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $article->picture) }}" alt="{{ $article->title }}" class="w-full h-32 object-cover rounded-md">
                                    </div>
                                    <input
                                        type="file"
                                        id="picture"
                                        name="picture"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm @error('picture') border-red-500 @enderror"
                                        accept="image/*"
                                    >
                                    <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current image</p>
                                    @error('picture')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-4 border-t border-gray-200 space-y-2">
                                    <button type="submit" class="w-full flex items-center justify-center rounded-md bg-black text-white px-4 py-2 text-sm font-medium">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Article
                                    </button>
                                    <a href="{{ route('articles.show', $article->id) }}" class="w-full flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Trix Editor initialized');

            // Configure file upload event
            document.addEventListener('trix-attachment-add', function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment);
                }
            });
        });

        function uploadFileAttachment(attachment) {
            console.log('Starting file upload:', attachment.file.name);

            // Get CSRF token from meta tag
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const formData = new FormData();
            formData.append('file', attachment.file);

            // Show upload progress
            attachment.setUploadProgress(0);

            fetch('{{ route("upload.trix-attachment") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Network error: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    if (data.url) {
                        console.log('Image URL:', data.url);
                        attachment.setAttributes({
                            url: data.url,
                            href: data.url
                        });
                    } else {
                        throw new Error('URL not found in response');
                    }
                })
                .catch(error => {
                    console.error('Error during upload:', error);
                    attachment.remove();
                })
                .finally(() => {
                    // Complete progress
                    attachment.setUploadProgress(100);
                });
        }
    </script>
@endsection
