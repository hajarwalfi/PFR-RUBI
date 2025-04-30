@extends('User.layouts.Template')

@section('title') RUBI - Community @endsection

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- Messages flash -->
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

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

                <div class="md:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden sticky top-4">
                        <div class="relative">
                            <div class="h-24 bg-gradient-to-r from-red-500 to-red-600"></div>
                            <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" class="h-20 w-20 rounded-full object-cover border-4 border-white">
                                @else
                                    <div class="h-20 w-20 rounded-full bg-red-100 flex items-center justify-center border-4 border-white">
                                        <span class="text-red-600 font-bold text-xl">{{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-12 pb-4 px-4 text-center">
                            <h2 class="font-semibold text-lg text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>

                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="grid grid-cols-3 gap-2 text-center">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ Auth::user()->posts->count() }}</p>
                                        <p class="text-xs text-gray-500">Posts</p>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ Auth::user()->comments->count() }}</p>
                                        <p class="text-xs text-gray-500">Comments</p>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ Auth::user()->donations()->count() }}</p>
                                        <p class="text-xs text-gray-500">Donations</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                            <ul class="space-y-2">
                                <li>
                                    <a href="{{ route('user.community.my-posts') }}" class="flex items-center text-sm text-gray-700 hover:text-red-600">
                                        <i class="ri-file-list-line mr-3 text-gray-400"></i> My Posts
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="flex items-center text-sm text-gray-700 hover:text-red-600">
                                        <i class="ri-user-settings-line mr-3 text-gray-400"></i> Edit Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="flex items-center text-sm text-gray-700 hover:text-red-600">
                                        <i class="ri-heart-pulse-line mr-3 text-gray-400"></i> Donation History
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-6">

                    <div class="bg-white rounded-lg shadow-xs border border-gray-200 overflow-hidden mb-6">
                        <div class=" p-4 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800 flex items-center">
                                <i class="ri-quill-pen-line mr-2 text-red-500"></i>
                                Share with the Community
                            </h3>
                        </div>

                        <div class="p-5">
                            <form action="{{ route('user.community.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex items-start space-x-4 mb-4">
                                    <!-- Avatar utilisateur -->
                                    <div class="flex-shrink-0">
                                        @if(Auth::user()->profile_photo_path)
                                            <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" class="h-12 w-12 rounded-full object-cover border border-gray-200">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center border border-gray-200">
                                                <span class="text-red-600 font-medium">{{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow space-y-3">

                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="ri-heading text-gray-400"></i>
                                            </div>
                                            <input type="text" name="title" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 transition-all" placeholder="Add a title to your post (optional)">
                                        </div>

                                        <div class="relative">
                                            <textarea name="content" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-red-500 focus:border-red-500 transition-all" placeholder="What's on your mind, {{ Auth::user()->first_name }}? Share your experience or ask a question..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <label for="media" class="flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md cursor-pointer transition-colors group">
                                            <i class="ri-image-line mr-2 text-blue-500 group-hover:text-blue-600"></i>
                                            <span class="text-sm">Photo/Video</span>
                                            <input id="media" name="media[]" type="file" class="hidden" multiple accept="image/*,video/*">
                                        </label>
                                        <span id="file-selected" class="ml-2 text-xs text-gray-500"></span>
                                    </div>

                                    <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm transition-colors flex items-center">
                                        <i class="ri-send-plane-fill mr-2"></i>
                                        <span>Share Post</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @if($posts->isEmpty())
                            <div class="text-center py-12 bg-gray-50 rounded-lg">
                                <i class="ri-chat-3-line text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500">No posts available yet. Be the first to share your story!</p>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                                    <!-- En-tête du post avec info utilisateur -->
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
                                        <div class="text-gray-400">
                                            <i class="ri-more-fill"></i>
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        @if($post->title)
                                            <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                                        @endif
                                        <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>
                                    </div>

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
                                                                <video class="w-full h-48 object-cover">
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
                                            <a href="{{ route('user.community.show', $post->id) }}" class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                                <i class="ri-chat-1-line mr-1"></i>
                                                {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                                            </a>
                                            <button class="flex items-center text-sm text-gray-600 hover:text-green-600">
                                                <i class="ri-share-line mr-1"></i> Share
                                            </button>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{ route('user.community.show', $post->id) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="md:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden sticky top-4 mb-6">
                        <div class="p-4 border-b border-gray-100">
                            <h3 class="font-semibold text-gray-900">Hall of Fame</h3>
                            <p class="text-xs text-gray-500 mt-1">Top contributors in our community</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach($topContributors ?? [] as $contributor)
                                <div class="p-3 flex items-center">
                                    <div class="flex-shrink-0 mr-3">
                                        @if($contributor->profile_photo_path)
                                            <img src="{{ Storage::url($contributor->profile_photo_path) }}" alt="{{ $contributor->first_name }} {{ $contributor->last_name }}" class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-red-600 font-medium text-sm">{{ strtoupper(substr($contributor->first_name, 0, 1) . substr($contributor->last_name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $contributor->first_name }} {{ $contributor->last_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $contributor->posts_count }} posts, {{ $contributor->comments_count }} comments</p>
                                    </div>
                                </div>
                            @endforeach


                            @if(empty($topContributors))
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="p-3 flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-red-600 font-medium text-sm">U{{ $i }}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">User {{ $i }}</p>
                                            <p class="text-xs text-gray-500">{{ 20 - $i * 2 }} posts, {{ 30 - $i * 3 }} comments</p>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
