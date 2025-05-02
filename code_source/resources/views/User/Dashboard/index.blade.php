@extends('User.layouts.Template')

@section('title') RUBI - Dashboard @endsection

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-4 py-8">
            <!-- En-tête de la page -->
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl md:text-4xl mb-3 text-gray-900">My Dashboard</h1>
                <div class="w-20 h-1 bg-red-500 mx-auto mb-6 rounded-full"></div>
                <p class="max-w-2xl mx-auto text-gray-600 text-sm md:text-base">
                    Manage your posts, comments, and track your activity in the RUBI community.
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

            <!-- Grille à 2 colonnes -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

                <!-- Colonne de gauche: Profil utilisateur et statistiques -->
                <div class="md:col-span-3">
                    <!-- Carte de profil -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden sticky top-4 mb-6">
                        <!-- Bannière et photo de profil -->
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

                        <!-- Informations utilisateur -->
                        <div class="pt-12 pb-4 px-4 text-center">
                            <h2 class="font-semibold text-lg text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
                            <p class="text-sm text-gray-500 mt-1">Member since {{ Auth::user()->created_at->format('M Y') }}</p>

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
                                    <a href="{{ route('user.dashboard') }}" class="flex items-center text-sm text-red-600 font-medium">
                                        <i class="ri-dashboard-line mr-3 text-red-500"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard.myPosts') }}" class="flex items-center text-sm text-gray-700 hover:text-red-600">
                                        <i class="ri-file-list-line mr-3 text-gray-400"></i> My Posts
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.community') }}" class="flex items-center text-sm text-gray-700 hover:text-red-600">
                                        <i class="ri-group-line mr-3 text-gray-400"></i> Community
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

                    <!-- Carte des statistiques -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden mb-6">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800 flex items-center">
                                <i class="ri-bar-chart-line mr-2 text-red-500"></i>
                                Activity Overview
                            </h3>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <!-- Statistique des vues -->
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm text-gray-600">Total Views</span>
                                        <span class="text-sm font-medium">{{ $totalViews ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>

                                <!-- Statistique des commentaires reçus -->
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm text-gray-600">Comments Received</span>
                                        <span class="text-sm font-medium">{{ $commentsReceived ?? 0 }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>

                                <!-- Statistique des posts approuvés -->
                                <div>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm text-gray-600">Approved Posts</span>
                                        <span class="text-sm font-medium">{{ $approvedPosts ?? 0 }}/{{ Auth::user()->posts->count() }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-red-500 h-2 rounded-full" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne de droite: Contenu principal -->
                <div class="md:col-span-9">
                    <!-- Onglets de navigation -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden mb-6">
                        <div class="flex border-b border-gray-200">
                            <button class="flex-1 py-3 px-4 text-center text-sm font-medium text-red-600 border-b-2 border-red-500">
                                <i class="ri-file-list-line mr-1"></i> My Posts
                            </button>
                            <button class="flex-1 py-3 px-4 text-center text-sm font-medium text-gray-500 hover:text-gray-700">
                                <i class="ri-chat-1-line mr-1"></i> My Comments
                            </button>
                            <button class="flex-1 py-3 px-4 text-center text-sm font-medium text-gray-500 hover:text-gray-700">
                                <i class="ri-bookmark-line mr-1"></i> Saved
                            </button>
                        </div>
                    </div>

                    <!-- Section des posts -->
                    <div class="space-y-6">
                        <!-- En-tête de la section -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">My Posts</h2>
                            <div class="flex items-center space-x-2">
                                <select class="text-sm border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="all">All Posts</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                <a href="{{ route('user.community') }}" class="inline-flex items-center px-4 py-1.5 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
                                    <i class="ri-add-line mr-1"></i> New Post
                                </a>
                            </div>
                        </div>

                        <!-- Liste des posts -->
                        @if(isset($posts) && $posts->count() > 0)
                            @foreach($posts as $post)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-4 flex justify-between items-start">
                                        <div>
                                            <!-- Titre et statut -->
                                            <div class="flex items-center mb-2">
                                                <h3 class="text-lg font-semibold text-gray-800">{{ $post->title ?? 'Untitled Post' }}</h3>
                                                <span class="ml-3 px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $post->status == 'approved' ? 'bg-green-100 text-green-800' :
                                                       ($post->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                       'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                            </div>

                                            <!-- Date et statistiques -->
                                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                                <span class="flex items-center mr-4">
                                                    <i class="ri-calendar-line mr-1"></i>
                                                    {{ $post->created_at->format('M d, Y') }}
                                                </span>
                                                <span class="flex items-center mr-4">
                                                    <i class="ri-eye-line mr-1"></i>
                                                    {{ $post->views ?? 0 }} views
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="ri-chat-1-line mr-1"></i>
                                                    {{ $post->comments->count() }} comments
                                                </span>
                                            </div>

                                            <!-- Aperçu du contenu -->
                                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($post->content, 150) }}</p>

                                            <!-- Aperçu des médias -->
                                            @if($post->media && $post->media->count() > 0)
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <i class="ri-image-line mr-1"></i>
                                                    {{ $post->media->count() }} {{ Str::plural('media', $post->media->count()) }} attached
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('user.community.show', $post->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('user.community.edit', $post->id) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-md transition-colors">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <form action="{{ route('user.community.destroy', $post->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                    <i class="ri-file-list-line text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No posts yet</h3>
                                <p class="text-gray-500 mb-4">You haven't created any posts yet. Share your experience with the community!</p>
                                <a href="{{ route('user.community') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
                                    <i class="ri-add-line mr-1"></i> Create Your First Post
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Section des commentaires (initialement cachée) -->
                    <div class="hidden space-y-6">
                        <!-- En-tête de la section -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">My Comments</h2>
                            <div>
                                <select class="text-sm border border-gray-300 rounded-md py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="newest">Newest First</option>
                                    <option value="oldest">Oldest First</option>
                                </select>
                            </div>
                        </div>

                        <!-- Liste des commentaires -->
                        @if(isset($comments) && $comments->count() > 0)
                            @foreach($comments as $comment)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                    <div class="p-4">
                                        <!-- En-tête avec info du post -->
                                        <div class="flex items-center justify-between mb-3">
                                            <div>
                                                <a href="{{ route('user.community.show', $comment->post->id) }}" class="text-sm font-medium text-blue-600 hover:underline">
                                                    On: {{ $comment->post->title ?? 'Untitled Post' }}
                                                </a>
                                                <p class="text-xs text-gray-500">{{ $comment->created_at->format('M d, Y') }} at {{ $comment->created_at->format('H:i') }}</p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <a href="{{ route('user.community.show', $comment->post->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <button class="p-1.5 text-yellow-600 hover:bg-yellow-50 rounded-md transition-colors">
                                                    <i class="ri-edit-line"></i>
                                                </button>
                                                <form action="{{ route('user.comments.destroy', $comment->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Contenu du commentaire -->
                                        <p class="text-gray-700 text-sm">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $comments->links() }}
                            </div>
                        @else
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                    <i class="ri-chat-1-line text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No comments yet</h3>
                                <p class="text-gray-500 mb-4">You haven't commented on any posts yet. Join the conversation!</p>
                                <a href="{{ route('user.community') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
                                    <i class="ri-chat-1-line mr-1"></i> Browse Community
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour la gestion des onglets -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.flex-1');
            const tabContents = document.querySelectorAll('.md\\:col-span-9 > .space-y-6');

            tabButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    // Réinitialiser tous les boutons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('text-red-600', 'border-b-2', 'border-red-500');
                        btn.classList.add('text-gray-500', 'hover:text-gray-700');
                    });

                    // Activer le bouton cliqué
                    button.classList.remove('text-gray-500', 'hover:text-gray-700');
                    button.classList.add('text-red-600', 'border-b-2', 'border-red-500');

                    // Masquer tous les contenus
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });

                    // Afficher le contenu correspondant
                    if (tabContents[index]) {
                        tabContents[index].classList.remove('hidden');
                    }
                });
            });
        });
    </script>
@endsection
