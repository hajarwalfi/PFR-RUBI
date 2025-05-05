@extends('User.layouts.Template')

@section('title') RUBI - Post Details @endsection

@section('content')
    <div class="bg-white min-h-screen py-10">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Back button -->
            <div class="mb-8">
                <a href="{{ route('user.community.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-red-500 transition-colors">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Back to Community
                </a>
            </div>

            <!-- Notifications -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-3 text-sm text-green-700">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-checkbox-circle-line text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{!! session('success') !!}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-3 text-sm text-red-700">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-error-warning-line text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Post Card -->
            <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <!-- Post Header -->
                <div class="p-5 flex items-center justify-between border-b border-gray-50">
                    <div class="flex items-center">
                        @if($post->user->profile_photo_path)
                            <img src="{{ Storage::url($post->user->profile_photo_path) }}" alt="{{ $post->user->first_name }}" class="h-9 w-9 rounded-full object-cover">
                        @else
                            <div class="h-9 w-9 rounded-full bg-red-50 flex items-center justify-center">
                                <span class="text-red-500 text-sm">{{ strtoupper(substr($post->user->first_name, 0, 1) . substr($post->user->last_name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                            <p class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @if($post->user_id === Auth::id())
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('user.community.edit', $post->id) }}" class="text-gray-400 hover:text-red-500 transition-colors">
                                <i class="ri-edit-line text-lg"></i>
                            </a>
                            <form action="{{ route('user.community.destroy', $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Post Content -->
                <div class="p-5">
                    @if($post->title)
                        <h1 class="text-xl font-light text-gray-800 mb-4">{{ $post->title }}</h1>
                    @endif
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $post->content }}</p>
                </div>

                <!-- Post Media -->
                @if($post->media && $post->media->count() > 0)
                    <div>
                        @if($post->media->count() == 1)
                            @php $media = $post->media->first(); @endphp
                            <div class="w-50 mx-auto">
                                @if(isset($media['type']) && $media['type'] == 'image')
                                    <img src="{{ Storage::url($media['path']) }}" alt="Post media" class="w-full h-auto">
                                @elseif(isset($media['type']) && $media['type'] == 'video')
                                    <video controls class="w-full h-auto">
                                        <source src="{{ Storage::url($media['path']) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @else
                            <div class="grid grid-cols-2 gap-0.5">
                                @foreach($post->media as $media)
                                    <div>
                                        @if(isset($media['type']) && $media['type'] == 'image')
                                            <img src="{{ Storage::url($media['path']) }}" alt="Post media" class="w-full h-48 object-cover">
                                        @elseif(isset($media['type']) && $media['type'] == 'video')
                                            <video controls class="w-full h-48 object-cover">
                                                <source src="{{ Storage::url($media['path']) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Post Footer -->
                <div class="px-5 py-3 bg-gray-50 text-xs text-gray-500 flex justify-between">
                    <div class="flex items-center">
                        <i class="ri-eye-line mr-1"></i> {{ $post->views }} Views
                    </div>
                    <div class="flex items-center">
                        <i class="ri-chat-1-line mr-1"></i>
                        {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                    </div>

                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50">
                    <h3 class="text-sm font-medium text-gray-700">Comments</h3>
                </div>

                <!-- Comments List -->
                <div class="divide-y divide-gray-50">
                    @forelse($post->comments as $comment)
                        <div class="p-4" id="comment-{{ $comment->id }}">
                            <div class="flex">
                                <div class="flex-shrink-0 mr-3">
                                    @if($comment->user->profile_photo_path)
                                        <img src="{{ Storage::url($comment->user->profile_photo_path) }}" alt="{{ $comment->user->first_name }}" class="h-8 w-8 rounded-full object-cover">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-red-50 flex items-center justify-center">
                                            <span class="text-red-500 text-xs">{{ strtoupper(substr($comment->user->first_name, 0, 1) . substr($comment->user->last_name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between mb-1">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</p>
                                            <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        @if($comment->user_id === Auth::id())
                                            <div class="flex items-center space-x-3">
                                                @if(request('edit_comment') != $comment->id)
                                                    <a href="{{ route('user.community.show', ['id' => $post->id, 'edit_comment' => $comment->id]) }}" class="text-gray-400 hover:text-red-500 transition-colors">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                @endif
                                                <form action="{{ route('user.community.comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                    @if(request('edit_comment') == $comment->id && $comment->user_id === Auth::id())
                                        <form action="{{ route('user.community.comments.update', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="content" rows="2" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-red-300 focus:border-red-300 resize-none">{{ $comment->content }}</textarea>
                                            <div class="flex justify-end mt-2 space-x-2">
                                                <a href="{{ route('user.community.show', $post->id) }}" class="px-3 py-1 text-xs text-gray-500 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                                                    Cancel
                                                </a>
                                                <button type="submit" class="px-3 py-1 text-xs text-white bg-red-500 rounded-md hover:bg-red-600 transition-colors">
                                                    Save
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <p class="text-sm text-gray-600">{{ $comment->content }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-5 text-center text-sm text-gray-400">
                            No comments yet. Be the first to comment!
                        </div>
                    @endforelse
                </div>

                <!-- Comment Form -->
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <form action="{{ route('user.community.comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name }}" class="h-8 w-8 rounded-full object-cover">
                                @else
                                    <div class="h-8 w-8 rounded-full bg-red-50 flex items-center justify-center">
                                        <span class="text-red-500 text-xs">{{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <textarea name="content" rows="2" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-red-300 focus:border-red-300 resize-none" placeholder="Write a comment..."></textarea>
                                <div class="mt-2 flex justify-end">
                                    <button type="submit" class="px-4 py-1.5 bg-red-500 text-white text-xs rounded-md hover:bg-red-600 transition-colors">
                                        Post Comment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
