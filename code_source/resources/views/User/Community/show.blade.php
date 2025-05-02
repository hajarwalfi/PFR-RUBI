@extends('User.layouts.Template')

@section('title') RUBI - Post Details @endsection

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto">
                <div class="mb-6">
                    <a href="{{ route('user.community.index') }}" class="flex items-center text-sm text-gray-600 hover:text-red-600 mb-4">
                        <i class="ri-arrow-left-line mr-2"></i> Back to Community
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="ri-checkbox-circle-line text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{!! session('success') !!}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="ri-error-warning-line text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-6">
                    <div class="p-4 flex items-center justify-between border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if($post->user->profile_photo_path)
                                    <img src="{{ Storage::url($post->user->profile_photo_path) }}" alt="{{ $post->user->first_name }} {{ $post->user->last_name }}" class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <span class="text-red-600 font-medium text-sm">{{ strtoupper(substr($post->user->first_name, 0, 1) . substr($post->user->last_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        @if($post->user_id === Auth::id())
                            <div class="flex space-x-2">
                                <form action="{{ route('user.community.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>
                    </div>

                    <!-- Médias du post -->
                    @if($post->media->count() > 0)
                        <div class="border-t border-gray-100">
                            @if($post->media->count() == 1)
                                @php $media = $post->media->first(); @endphp
                                <div class="w-full">
                                    @if($media->type == 'image')
                                        <img src="{{ Storage::url($media->path) }}" alt="Post media" class="w-full h-auto">
                                    @else
                                        <video controls class="w-full h-auto">
                                            <source src="{{ Storage::url($media->path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                </div>
                            @else
                                <div class="grid grid-cols-2 gap-1">
                                    @foreach($post->media as $media)
                                        <div>
                                            @if($media->type == 'image')
                                                <img src="{{ Storage::url($media->path) }}" alt="Post media" class="w-full h-48 object-cover">
                                            @else
                                                <video controls class="w-full h-48 object-cover">
                                                    <source src="{{ Storage::url($media->path) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                        <div class="flex justify-between mb-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="ri-eye-line mr-1"></i> {{ $post->views }} Views
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="ri-chat-1-line mr-1"></i>
                                {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                            </div>
                            <button class="flex items-center text-sm text-gray-600 hover:text-green-600">
                                <i class="ri-share-line mr-1"></i> Share
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-900">Comments</h3>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($post->comments as $comment)
                            <div class="p-4" id="comment-{{ $comment->id }}">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mr-3">
                                        @if($comment->user->profile_photo_path)
                                            <img src="{{ Storage::url($comment->user->profile_photo_path) }}" alt="{{ $comment->user->first_name }} {{ $comment->user->last_name }}" class="h-8 w-8 rounded-full object-cover">
                                        @else
                                            <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-red-600 font-medium text-xs">{{ strtoupper(substr($comment->user->first_name, 0, 1) . substr($comment->user->last_name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between mb-1">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 mr-2">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</p>
                                                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            @if($comment->user_id === Auth::id())
                                                <div class="flex space-x-2">
                                                    @if(request('edit_comment') == $comment->id)
                                                    @else
                                                        <a href="{{ route('user.community.show', ['id' => $post->id, 'edit_comment' => $comment->id]) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                                            <i class="ri-edit-line"></i> Edit
                                                        </a>
                                                    @endif
                                                    <form action="{{ route('user.community.comments.destroy', $comment->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-xs text-red-600 hover:text-red-800">
                                                            <i class="ri-delete-bin-line"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>

                                        @if(request('edit_comment') == $comment->id && $comment->user_id === Auth::id())
                                            <form action="{{ route('user.community.comments.update', $comment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="content" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">{{ $comment->content }}</textarea>
                                                <div class="flex justify-end mt-2 space-x-2">
                                                    <a href="{{ route('user.community.show', $post->id) }}" class="px-3 py-1 text-xs text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300">
                                                        Cancel
                                                    </a>
                                                    <button type="submit" class="px-3 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            <p class="text-sm text-gray-800">{{ $comment->content }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500">
                                No comments yet. Be the first to comment!
                            </div>
                        @endforelse
                    </div>

                    <div class="p-4 bg-gray-50 border-t border-gray-100">
                        <form action="{{ route('user.community.comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    @if(Auth::user()->profile_photo_path)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" class="h-8 w-8 rounded-full object-cover">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                            <span class="text-red-600 font-medium text-xs">{{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <textarea name="content" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500" placeholder="Write a comment..."></textarea>
                                    <div class="mt-2 flex justify-end">
                                        <button type="submit" class="px-4 py-1.5 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
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
    </div>
@endsection
