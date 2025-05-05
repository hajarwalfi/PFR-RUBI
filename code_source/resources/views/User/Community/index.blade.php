@extends('User.layouts.Template')
@section('title') RUBI - Community @endsection

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- Flash messages -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                    <p class="text-sm text-green-700">{!! session('success') !!}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-10 gap-6">
                <!-- User Profile Sidebar -->
                <div class="md:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 sticky top-4">
                        <div class="relative">
                            <div class="h-24 bg-gray-50"></div>
                            <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name }}" class="h-20 w-20 rounded-full object-cover border-4 border-white">
                                @else
                                    <div class="h-20 w-20 rounded-full bg-red-100 flex items-center justify-center border-4 border-white">
                                        <span class="text-red-600 font-bold text-xl">{{ strtoupper(substr(Auth::user()->first_name, 0, 1) . substr(Auth::user()->last_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-12 pb-4 px-4 text-center">
                            <h2 class="font-semibold text-lg">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                            <!-- User Stats -->
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="grid grid-cols-3 gap-2 text-center">
                                    <div><p class="font-bold">{{ Auth::user()->posts->count() }}</p><p class="text-xs text-gray-500">Posts</p></div>
                                    <div><p class="font-bold">{{ Auth::user()->comments->count() }}</p><p class="text-xs text-gray-500">Comments</p></div>
                                    <div><p class="font-bold">{{ Auth::user()->donations()->count() }}</p><p class="text-xs text-gray-500">Donations</p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                            <ul class="space-y-2">
                                <li><a href="{{ route('dashboard.myPosts') }}" class="flex items-center text-sm text-gray-700 hover:text-red-600"><i class="ri-file-list-line mr-3 text-gray-400"></i> My Posts</a></li>
                                <li><a href="{{route('dashboard.profile')}}" class="flex items-center text-sm text-gray-700 hover:text-red-600"><i class="ri-user-settings-line mr-3 text-gray-400"></i> Edit Profile</a></li>
                                <li><a href="{{route('dashboard.donations')}}" class="flex items-center text-sm text-gray-700 hover:text-red-600"><i class="ri-heart-pulse-line mr-3 text-gray-400"></i> Donation History</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="md:col-span-6">
                    <!-- Post Creation Form -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
                        <div class="p-3 border-b border-gray-50">
                            <h3 class="text-sm font-medium text-gray-700"><i class="ri-quill-pen-line mr-2 text-red-500 text-xs"></i> Share</h3>
                        </div>
                        <div class="p-3">
                            <form action="{{ route('user.community.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex items-start space-x-3">
                                    <!-- User avatar -->
                                    <div class="flex-shrink-0 hidden sm:block">
                                        @if(Auth::user()->profile_photo_path)
                                            <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->first_name }}" class="h-8 w-8 rounded-full object-cover">
                                        @else
                                            <div class="h-8 w-8 rounded-full bg-red-50 flex items-center justify-center">
                                                <span class="text-red-500 text-xs font-medium">{{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow space-y-2">
                                        <input type="text" name="title" class="w-full px-3 py-2 text-sm bg-gray-50 border-0 rounded-md focus:ring-1 focus:ring-red-400" placeholder="Title (optional)">
                                        <textarea name="content" rows="2" class="w-full px-3 py-2 text-sm bg-gray-50 border-0 rounded-md focus:ring-1 focus:ring-red-400 resize-none" placeholder="Share your experience..."></textarea>
                                        <div class="flex items-center justify-between pt-2">
                                            <div class="flex items-center space-x-2">
                                                <label for="media" class="flex items-center text-xs text-gray-500 hover:text-gray-700 cursor-pointer">
                                                    <i class="ri-image-line mr-1 text-gray-400"></i>
                                                    <span>Media</span>
                                                    <input id="media" name="media[]" type="file" class="hidden" multiple accept="image/*,video/*">
                                                </label>
                                                <span id="file-selected" class="text-xs text-gray-400"></span>
                                            </div>
                                            <button type="submit" class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs rounded-md">Publish</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Posts Feed -->
                    <div class="space-y-6">
                        @if($posts->isEmpty())
                            <div class="text-center py-12 bg-gray-50 rounded-lg">
                                <i class="ri-chat-3-line text-gray-300 text-5xl mb-4"></i>
                                <p class="text-gray-500">No posts available yet. Be the first to share your story!</p>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-100">
                                    <!-- Post header -->
                                    <div class="p-4 flex items-center border-b border-gray-100">
                                        <div class="flex-shrink-0">
                                            @if($post->user->profile_photo_path)
                                                <img src="{{ Storage::url($post->user->profile_photo_path) }}" alt="{{ $post->user->first_name }}" class="h-10 w-10 rounded-full object-cover">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                    <span class="text-red-600 font-medium text-sm">{{ strtoupper(substr($post->user->first_name, 0, 1) . substr($post->user->last_name, 0, 1)) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium">{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    <!-- Post content -->
                                    <div class="p-4">
                                        @if($post->title)
                                            <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                                        @endif
                                        <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>
                                    </div>

                                    <!-- Post media -->
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
                                                                </video>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Post footer -->
                                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                                        <div class="flex justify-between mb-2">
                                            <div class="text-sm text-gray-600"><i class="ri-eye-line mr-1"></i> {{ $post->views }} Views</div>
                                            <a href="{{ route('user.community.show', $post->id) }}" class="text-sm text-gray-600 hover:text-blue-600">
                                                <i class="ri-chat-1-line mr-1"></i> {{ $post->comments->count() }} {{ Str::plural('Comment', $post->comments->count()) }}
                                            </a>
                                        </div>
                                        <div class="text-right">
                                            <a href="{{ route('user.community.show', $post->id) }}" class="text-xs text-blue-600 hover:text-blue-800">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('media');
            const fileSelected = document.getElementById('file-selected');
            fileInput.addEventListener('change', function() {
                fileSelected.textContent = fileInput.files.length > 0 ? fileInput.files.length + ' file(s)' : '';
            });
        });
    </script>
@endsection
