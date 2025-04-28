@extends('User.layouts.Template')

@section('title') RUBI - Community @endsection

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- En-tête de la page -->
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl md:text-4xl mb-3 text-gray-900">Community</h1>
                <div class="w-20 h-1 bg-red-500 mx-auto mb-6 rounded-full"></div>
                <p class="max-w-2xl mx-auto text-gray-600 text-sm md:text-base">
                    Connect with fellow blood donors, share your experiences, and inspire others to join the cause.
                </p>
            </div>

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

            <!-- Grille à 3 colonnes -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

                <!-- Colonne de gauche: Profil utilisateur -->
                <div class="md:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden sticky top-4">
                        <!-- Bannière et photo de profil -->
                        <div class="relative">
                            <div class="h-24 bg-gradient-to-r from-red-500 to-red-600"></div>
                            <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="h-20 w-20 rounded-full object-cover border-4 border-white">
                                @else
                                    <div class="h-20 w-20 rounded-full bg-red-100 flex items-center justify-center border-4 border-white">
                                        <span class="text-red-600 font-bold text-xl">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Informations utilisateur -->
                        <div class="pt-12 pb-4 px-4 text-center">
                            <h2 class="font-semibold text-lg text-gray-900">{{ Auth::user()->name }}</h2>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>

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

                        <!-- Liens rapides -->
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

                <!-- Colonne du milieu: Création de post et fil d'actualité -->
                <div class="md:col-span-6">
                    <!-- Formulaire de création de post -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-6">
                        <div class="p-4">
                            <form action="{{ route('user.community.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex items-center space-x-3 mb-3">
                                    @if(Auth::user()->profile_photo_path)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                            <span class="text-red-600 font-medium text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                    <div class="flex-grow">
                                        <textarea id="content" name="content" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500" placeholder="What's on your mind, {{ Auth::user()->name }}?"></textarea>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-3 flex justify-between">
                                    <div class="flex items-center">
                                        <label for="media" class="flex items-center text-sm text-gray-600 hover:bg-gray-100 px-3 py-1.5 rounded-md cursor-pointer">
                                            <i class="ri-image-line text-blue-500 mr-2"></i> Photo/Video
                                            <input id="media" name="media[]" type="file" class="hidden" multiple accept="image/*,video/*">
                                        </label>
                                        <span id="file-selected" class="ml-2 text-xs text-gray-500"></span>
                                    </div>
                                    <button type="submit" class="flex items-center text-sm text-white bg-red-600 hover:bg-red-700 px-4 py-1.5 rounded-md">
                                        <i class="ri-send-plane-fill mr-2"></i> Post
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Liste des posts -->
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
                                                    <img src="{{ Storage::url($post->user->profile_photo_path) }}" alt="{{ $post->user->name }}" class="h-10 w-10 rounded-full object-cover">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                        <span class="text-red-600 font-medium text-sm">{{ strtoupper(substr($post->user->name, 0, 2)) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="text-gray-400">
                                            <i class="ri-more-fill"></i>
                                        </div>
                                    </div>

                                    <!-- Contenu du post -->
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

                                    <!-- Pied de post avec actions -->
                                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                                        <div class="flex justify-between mb-2">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class="ri-eye-line mr-1"></i> {{ rand(5, 100) }} Views
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

                <!-- Colonne de droite: Hall of Fame -->
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
                                            <img src="{{ Storage::url($contributor->profile_photo_path) }}" alt="{{ $contributor->name }}" class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-red-600 font-medium text-sm">{{ strtoupper(substr($contributor->name, 0, 2)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $contributor->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $contributor->posts_count }} posts, {{ $contributor->comments_count }} comments</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Afficher des exemples si $topContributors est vide -->
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
