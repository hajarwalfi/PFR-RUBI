@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - Posts')


@section('content')
    <main class="flex-1 overflow-auto p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold mb-1">Moderation</h1>
                <p class="text-gray-500">Manage and moderate user posts and comments</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <!-- Pending -->
                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Pending</h3>
                        <p class="text-4xl font-bold">12</p>
                    </div>
                    <div class="text-yellow-400">
                        <i class="far fa-clock text-2xl"></i>
                    </div>
                </div>

                <!-- Approved -->
                <div class="bg-green-50 border border-green-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Approved</h3>
                        <p class="text-4xl font-bold">156</p>
                    </div>
                    <div class="text-green-500">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>

                <!-- Rejected -->
                <div class="bg-red-50 border border-red-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Rejected</h3>
                        <p class="text-4xl font-bold">23</p>
                    </div>
                    <div class="text-red-500">
                        <i class="fas fa-times-circle text-2xl"></i>
                    </div>
                </div>

                <!-- Archived -->
                <div class="bg-gray-50 border border-gray-100 rounded-lg p-5 flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-700 text-base mb-1">Archived</h3>
                        <p class="text-4xl font-bold">45</p>
                    </div>
                    <div class="text-gray-400">
                        <i class="fas fa-archive text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Main content in two columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Posts list -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="p-4 border-b border-gray-200">
                        <h2 class="text-2xl font-bold">User Posts</h2>
                    </div>

                    <!-- Filters -->
                    <div class="flex bg-gray-100 rounded-md p-1 m-4">
                        <button class="py-2 px-4 rounded-md text-black font-medium bg-white shadow-sm" data-filter="pending">Pending</button>
                        <button class="py-2 px-4 rounded-md text-gray-500" data-filter="approved">Approved</button>
                        <button class="py-2 px-4 rounded-md text-gray-500" data-filter="rejected">Rejected</button>
                        <button class="py-2 px-4 rounded-md text-gray-500" data-filter="archived">Archived</button>
                    </div>

                    <!-- Posts list -->
                    <div class="divide-y divide-gray-200">
                        <!-- Post 1 - Pending -->
                        <div class="p-4 hover:bg-gray-50 post-item" data-status="pending">
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium">Question about blood donation</h3>
                                <div class="flex space-x-3">
                                    <button class="text-green-500"><i class="fas fa-check"></i></button>
                                    <button class="text-red-500"><i class="fas fa-times"></i></button>
                                    <button class="text-gray-400"><i class="fas fa-archive"></i></button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-1">By Ahmed Benali • 2023-06-15</p>
                            <p class="text-sm mb-2">Hello, I would like to know if I can ...</p>
                            <div class="flex text-sm text-gray-500">
                                <span class="mr-4">2 comments</span>
                                <span>5 likes • 42 views</span>
                            </div>
                        </div>

                        <!-- Post 2 - Approved -->
                        <div class="p-4 hover:bg-gray-50 post-item" data-status="approved">
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium">University donation campaign</h3>
                                <div class="flex space-x-3">
                                    <button class="text-green-500"><i class="fas fa-check"></i></button>
                                    <button class="text-red-500"><i class="fas fa-times"></i></button>
                                    <button class="text-gray-400"><i class="fas fa-archive"></i></button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-1">By Leila Kadiri • 2023-06-12</p>
                            <p class="text-sm mb-2">We are organizing a donation campaign...</p>
                            <div class="flex text-sm text-gray-500">
                                <span class="mr-4">1 comment</span>
                                <span>8 likes • 56 views</span>
                            </div>
                        </div>

                        <!-- Post 3 - Rejected -->
                        <div class="p-4 hover:bg-gray-50 post-item" data-status="rejected">
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium">Issue with my account</h3>
                                <div class="flex space-x-3">
                                    <button class="text-green-500"><i class="fas fa-check"></i></button>
                                    <button class="text-red-500"><i class="fas fa-times"></i></button>
                                    <button class="text-gray-400"><i class="fas fa-archive"></i></button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-1">By Mohamed Alami • 2023-06-10</p>
                            <p class="text-sm mb-2">I can't log into my account...</p>
                            <div class="flex text-sm text-gray-500">
                                <span class="mr-4">0 comments</span>
                                <span>2 likes • 15 views</span>
                            </div>
                        </div>

                        <!-- Post 4 - Archived -->
                        <div class="p-4 hover:bg-gray-50 post-item" data-status="archived">
                            <div class="flex justify-between mb-2">
                                <h3 class="font-medium">Past campaign completed</h3>
                                <div class="flex space-x-3">
                                    <button class="text-green-500"><i class="fas fa-check"></i></button>
                                    <button class="text-red-500"><i class="fas fa-times"></i></button>
                                    <button class="text-gray-400"><i class="fas fa-archive"></i></button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-1">By Admin • 2023-05-20</p>
                            <p class="text-sm mb-2">The May donation campaign is...</p>
                            <div class="flex text-sm text-gray-500">
                                <span class="mr-4">5 comments</span>
                                <span>12 likes • 120 views</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post details -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Question about blood donation</h2>
                        <span class="bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full">Pending</span>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500 mb-4">By Ahmed Benali • 2023-06-15</p>

                        <p class="mb-6">Hello, I would like to know if I can donate blood if I have recently taken medications?</p>

                        <div class="flex items-center space-x-6 mb-6">
                            <div class="flex items-center">
                                <i class="far fa-comment text-gray-500 mr-2"></i>
                                <span>2</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-thumbs-up text-gray-500 mr-2"></i>
                                <span>5</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-eye text-gray-500 mr-2"></i>
                                <span>42</span>
                            </div>
                        </div>

                        <div class="flex space-x-3">
                            <button class="flex items-center px-4 py-2 bg-white border border-green-500 text-green-600 rounded-md">
                                <i class="fas fa-check mr-2"></i>
                                Approve
                            </button>
                            <button class="flex items-center px-4 py-2 bg-white border border-red-500 text-red-600 rounded-md">
                                <i class="fas fa-times mr-2"></i>
                                Reject
                            </button>
                            <button class="flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md">
                                <i class="fas fa-archive mr-2"></i>
                                Archive
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
