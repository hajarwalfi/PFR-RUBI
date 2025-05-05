@extends('User.layouts.aside')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6  max-w-6xl">
            <div class="mb-12">
                <h1 class="font-serif text-3xl mb-2 text-red-800">My Posts</h1>
                <p class="text-gray-600 text-sm">Manage your posts and track their status</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <div class=" p-6 rounded-lg border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-serif mb-1 text-red-800">{{ $posts->count() }}</div>
                            <div class="text-xs uppercase tracking-wider text-red-600">Total Posts</div>
                        </div>
                        <div class="w-10 h-10 rounded-full  flex items-center justify-center">
                            <i class="fas fa-file-alt text-red-500"></i>
                        </div>
                    </div>
                </div>
                <div class=" p-6 rounded-lg border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-serif mb-1 text-red-800">{{ $posts->where('status', 'approved')->count() }}</div>
                            <div class="text-xs uppercase tracking-wider text-red-600">Approved</div>
                        </div>
                        <div class="w-10 h-10 rounded-full  flex items-center justify-center">
                            <i class="fas fa-check-circle text-red-500"></i>
                        </div>
                    </div>
                </div>
                <div class=" p-6 rounded-lg border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-serif mb-1 text-red-800">{{ $posts->where('status', 'pending')->count() }}</div>
                            <div class="text-xs uppercase tracking-wider text-red-600">Pending</div>
                        </div>
                        <div class="w-10 h-10 rounded-full  flex items-center justify-center">
                            <i class="fas fa-clock text-red-500"></i>
                        </div>
                    </div>
                </div>
                <div class=" p-6 rounded-lg border border-red-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-3xl font-serif mb-1 text-red-800">{{ $posts->sum('views') }}</div>
                            <div class="text-xs uppercase tracking-wider text-red-600">Total Views</div>
                        </div>
                        <div class="w-10 h-10 rounded-full  flex items-center justify-center">
                            <i class="fas fa-eye text-red-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($posts as $post)
                        <div class="bg-white  rounded-lg shadow-sm ">
                            <!-- Post Header -->
                            <div class="p-3 border-b border-red-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-red-800">
                                            @if($post->title)
                                                {{ Str::limit($post->title, 20) }}
                                            @else
                                                <span class="text-gray-400 italic">Untitled</span>
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="flex space-x-2">
                                        @if($post->status == 'approved')
                                            <a href="{{ route('user.community.show', $post->id) }}" class="text-xs font-medium text-red-600 hover:text-red-800">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-1">
                                    <div class="text-xs text-gray-500">
                                        {{ $post->created_at->format('d/m/Y') }}
                                    </div>
                                    <div>
                                        @if($post->status == 'pending')
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1 text-xs"></i>
                                                Pending
                                            </span>
                                        @elseif($post->status == 'approved')
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Approved
                                            </span>
                                        @elseif($post->status == 'rejected')
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium text-red-800">
                                                <i class="fas fa-times-circle mr-1 text-xs"></i>
                                                Rejected
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <div class="text-gray-600 text-sm ">
                                    {{ Str::limit($post->content, 60) }}
                                </div>

                                <div class="flex items-center justify-between mt-2 pt-2 border-t border-red-50 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1"></i>
                                            {{ $post->views ?? 0 }}
                                        </span>

                                        @if($post->comments && $post->comments->count() > 0)
                                            <span class="mx-2">•</span>
                                            <span class="flex items-center">
                                                <i class="fas fa-comment mr-1"></i>
                                                {{ $post->comments->count() }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($post->media && $post->media->count() > 0)
                                        <span class="text-xs text-gray-400">
                                            <i class="fas fa-paperclip mr-1"></i>
                                            {{ $post->media->count() }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="mt-8 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-red-50 rounded-lg border border-red-100">
                    <i class="fas fa-file-alt text-red-300 text-4xl"></i>
                    <h3 class="mt-4 text-lg font-medium text-red-800">No posts found</h3>
                    <p class="mt-1 text-sm text-red-600">You haven't created any posts with this status yet.</p>
                    <div class="mt-6">
                        <a href="{{route('user.community.index')}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Create a post
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
