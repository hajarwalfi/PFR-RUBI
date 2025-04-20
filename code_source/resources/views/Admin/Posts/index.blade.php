@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Posts')


@section('content')

    <main class="flex-1 overflow-auto p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-red-800 mb-1">Moderation</h1>
                <p class="text-gray-700 text-sm">Manage and moderate user posts and comments</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

                <!-- Pending -->
                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Pending</h3>
                        <p class="text-4xl font-bold">{{ $pendingCount }}</p>
                    </div>
                    <div class="text-yellow-400">
                        <i class="far fa-clock text-2xl"></i>
                    </div>
                </div>

                <!-- Approved -->
                <div class="bg-green-50 border border-green-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Approved</h3>
                        <p class="text-4xl font-bold">{{ $approvedCount }}</p>
                    </div>
                    <div class="text-green-500">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>

                <!-- Rejected -->
                <div class="bg-red-50 border border-red-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Rejected</h3>
                        <p class="text-4xl font-bold">{{ $rejectedCount }}</p>
                    </div>
                    <div class="text-red-500">
                        <i class="fas fa-times-circle text-2xl"></i>
                    </div>
                </div>

                <!-- Archived -->
                <div class="bg-gray-50 border border-gray-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Archived</h3>
                        <p class="text-4xl font-bold">{{ $archivedCount }}</p>
                    </div>
                    <div class="text-gray-400">
                        <i class="fas fa-archive text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Main content in two columns with unequal widths -->
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-1 bg-white border border-gray-200 rounded-lg overflow-hidden">

                    <div class="p-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold">User Posts</h2>
                    </div>

                    <div class="bg-gray-100 rounded-lg p-1 mx-2 my-3">
                        <div class="flex w-full justify-between">
                            <a href="{{ route('moderation', ['status' => 'pending']) }}"
                               class="text-center py-1 px-1.5 text-xs rounded-md transition-colors duration-200 ease-in-out flex-1 mx-0.5
                                    {{ $status === 'pending' ? 'bg-white text-gray-800 font-medium shadow-sm' : 'text-gray-600 hover:bg-gray-200' }}">
                                <i class="far fa-clock mr-0.5"></i>Pending
                            </a>
                            <a href="{{ route('moderation', ['status' => 'approved']) }}"
                               class="text-center py-1 px-1.5 text-xs rounded-md transition-colors duration-200 ease-in-out flex-1 mx-0.5
                                    {{ $status === 'approved' ? 'bg-white text-gray-800 font-medium shadow-sm' : 'text-gray-600 hover:bg-gray-200' }}">
                                <i class="fas fa-check-circle mr-0.5"></i>Approved
                            </a>
                            <a href="{{ route('moderation', ['status' => 'rejected']) }}"
                               class="text-center py-1 px-1.5 text-xs rounded-md transition-colors duration-200 ease-in-out flex-1 mx-0.5
                                   {{ $status === 'rejected' ? 'bg-white text-gray-800 font-medium shadow-sm' : 'text-gray-600 hover:bg-gray-200' }}">
                                <i class="fas fa-times-circle mr-0.5"></i>Rejected
                            </a>
                            <a href="{{ route('moderation', ['status' => 'archived']) }}"
                               class="text-center py-1 px-1.5 text-xs rounded-md transition-colors duration-200 ease-in-out flex-1 mx-0.5
                                    {{ $status === 'archived' ? 'bg-white text-gray-800 font-medium shadow-sm' : 'text-gray-600 hover:bg-gray-200' }}">
                                <i class="fas fa-archive mr-0.5"></i>Archived
                            </a>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-200">
                        @forelse($posts as $post)
                            <div class="p-4 hover:bg-gray-50 post-item" data-status="{{ $post->status }}">
                                <div class="flex justify-between mb-2">
                                    <h3 class="font-medium">
                                        <a href="{{ route('moderation', ['status' => $status, 'post_id' => $post->id]) }}"
                                           class="hover:underline">
                                            {{ $post->title ?? 'Untitled Post' }}
                                        </a>
                                    </h3>
                                    <div class="flex space-x-3">
                                        <!-- Contextual action buttons based on post status -->
                                        @if($post->status == 'pending')
                                            <form action="{{ route('posts.approve', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-500 hover:text-green-700" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('posts.reject', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @elseif($post->status == 'approved')
                                            <form action="{{ route('posts.reject', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('posts.archive', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-gray-400 hover:text-gray-600" title="Archive">
                                                    <i class="fas fa-archive"></i>
                                                </button>
                                            </form>
                                        @elseif($post->status == 'rejected')
                                            <form action="{{ route('posts.approve', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-500 hover:text-green-700" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @elseif($post->status == 'archived')
                                            <form action="{{ route('posts.approve', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-500 hover:text-green-700" title="Restore">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mb-1">By {{ $post->user->name ?? 'Unknown' }}
                                    • {{ $post->created_at->format('Y-m-d') }}</p>
                                <p class="text-sm mb-2">{{ Str::limit($post->content, 50) ?? 'No content' }}</p>

                                <!-- Only show comments and views for approved or archived posts -->
                                @if(in_array($post->status, ['approved', 'archived']))
                                    <div class="flex text-sm text-gray-500">
                                        <span class="mr-4">{{ $post->comments->count() ?? 0 }} comments</span>
                                        <span>{{ $post->views ?? 0 }} views</span>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500">
                                <p>No posts to display</p>
                            </div>
                        @endforelse
                    </div>

                </div>

                <div class="col-span-2 bg-white border border-gray-200 rounded-lg overflow-hidden">
                    @if($selectedPost)
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="text-xl font-bold">{{ $selectedPost->title ?? 'Untitled Post' }}</h2>
                            <div class="flex items-center space-x-3">
                                <span class="bg-{{ $selectedPost->status == 'pending' ? 'yellow' : ($selectedPost->status == 'approved' ? 'green' : ($selectedPost->status == 'rejected' ? 'red' : 'gray')) }}-100
                                   text-{{ $selectedPost->status == 'pending' ? 'yellow' : ($selectedPost->status == 'approved' ? 'green' : ($selectedPost->status == 'rejected' ? 'red' : 'gray')) }}-800
                                   text-xs px-3 py-1 rounded-full">
                                    {{ ucfirst($selectedPost->status) }}
                                </span>

                                <!-- Contextual action icons next to status badge -->
                                <div class="flex space-x-2 ml-2">
                                    @if($selectedPost->status == 'pending')
                                        <form action="{{ route('posts.approve', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-500 hover:text-green-700 transition-colors" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('posts.reject', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @elseif($selectedPost->status == 'approved')
                                        <form action="{{ route('posts.reject', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('posts.archive', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-gray-400 hover:text-gray-600 transition-colors" title="Archive">
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </form>
                                    @elseif($selectedPost->status == 'rejected')
                                        <form action="{{ route('posts.approve', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-500 hover:text-green-700 transition-colors" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @elseif($selectedPost->status == 'archived')
                                        <form action="{{ route('posts.approve', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-500 hover:text-green-700 transition-colors" title="Restore">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('posts.destroy', $selectedPost->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-500 mb-4">By {{ $selectedPost->user ? $selectedPost->user->first_name.' '.$selectedPost->user->last_name : 'Unknown' }}
                                • {{ $selectedPost->created_at->format('Y-m-d') }}</p>

                            <p class="mb-6">{{ $selectedPost->content ?? 'No content' }}</p>

                            @if($selectedPost->media && $selectedPost->media->count() > 0)
                                <div class="mb-6">
                                    <h3 class="text-sm font-medium mb-2">Media:</h3>
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach($selectedPost->media as $media)
                                            <div class="border rounded overflow-hidden">
                                                @if(Str::contains($media->mime_type, 'image'))
                                                    <img src="{{ $media->url }}" alt="Post media" class="w-full h-auto">
                                                @elseif(Str::contains($media->mime_type, 'video'))
                                                    <video controls class="w-full h-auto">
                                                        <source src="{{ $media->url }}" type="{{ $media->mime_type }}">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <div class="p-4 text-center text-gray-500">
                                                        <i class="fas fa-file text-2xl mb-2"></i>
                                                        <p>{{ $media->file_name }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Only show comments and views for approved or archived posts -->
                            @if(in_array($selectedPost->status, ['approved', 'archived']))
                                <div class="flex items-center space-x-6 mb-6">
                                    <div class="flex items-center">
                                        <i class="far fa-comment text-gray-500 mr-2"></i>
                                        <span>{{ $selectedPost->comments->count() }}</span>
                                    </div>

                                    <div class="flex items-center">
                                        <i class="far fa-eye text-gray-500 mr-2"></i>
                                        <span>{{ $selectedPost->views ?? 0 }}</span>
                                    </div>
                                </div>
                            @endif


                            @if(in_array($selectedPost->status, ['approved', 'archived']) && $selectedPost->comments && $selectedPost->comments->count() > 0)
                                <div class="mt-8">
                                    <h3 class="text-lg font-medium mb-4">Comments</h3>
                                    <div class="space-y-4">
                                        @foreach($selectedPost->comments as $comment)
                                            <div class="bg-gray-50 p-4 rounded">
                                                <div class="flex justify-between mb-2">
                                                    <p class="text-sm font-medium">{{ $comment->user->name ?? 'Unknown' }}</p>
                                                    <p class="text-xs text-gray-500">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                                                </div>
                                                <p class="text-sm">{{ $comment->content }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="p-8 text-center text-gray-500">
                            <p>Select a post to view details</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
