@extends('Admin.layouts.aside')
@section('title', 'RUBI Admin - User Post Moderation')

@section('content')
    <main class="flex-1">
        <div class="flex-1">
            <!-- Navigation -->
            <div class="p-4 flex justify-between items-center border-b border-gray-200">
                <div class="flex items-center space-x-2 text-xs">
                    <a href="#" class="inline-flex items-center p-2 rounded-md hover:bg-gray-100">
                        <i class="fas fa-arrow-left h-5 w-5"></i>
                    </a>
                    <div class="flex items-center text-gray-500">
                        <a href="#" class="hover:text-black hover:underline">User Posts</a>
                        <span class="mx-2">&gt;</span>
                        <a href="#" class="hover:text-black hover:underline">My Experience with RUBI App</a>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                        <i class="fas fa-check h-5 w-5"></i>
                        <span>Approve</span>
                    </button>

                    <button type="button" class="bg-red-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                        <i class="fas fa-times h-5 w-5"></i>
                        <span>Disapprove</span>
                    </button>
                </div>
            </div>

            <!-- Post Information -->
            <div class="p-6">
                <!-- Title and publication date -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-1">My Experience with RUBI App</h2>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-xs">
                            <i class="far fa-calendar-alt h-3 w-5 text-gray-500 mr-1"></i>
                            <span class="text-gray-600">Posted at 15/04/2023</span>
                        </div>
                        <div class="flex items-center text-xs">
                            <i class="far fa-user h-3 w-5 text-gray-500 mr-1"></i>
                            <span class="text-gray-600">By John Doe</span>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                            Pending
                        </span>
                    </div>
                </div>

                <!-- Information sections with custom grid -->
                <div class="grid grid-cols-12 gap-6">
                    <!-- Post Information -->
                    <div class="col-span-12 md:col-span-4 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Section title -->
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <i class="fas fa-info-circle h-5 w-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">Post Information</h3>
                                <p class="text-xs text-gray-500">Details and metadata</p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-spinner h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Status</span>
                            </div>
                            <p class="font-medium text-sm pl-7 text-yellow-600">
                                Pending
                            </p>
                        </div>

                        <!-- User Information -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="far fa-user h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Posted by</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">John Doe</p>
                            <p class="text-xs text-gray-500 pl-7">john.doe@example.com</p>
                        </div>

                        <!-- Created Date -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="far fa-clock h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Created on</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">15/04/2023</p>
                        </div>

                        <!-- Modified Date -->
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-pencil-alt h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Modified on</span>
                            </div>
                            <p class="font-medium pl-7 text-sm">15/04/2023</p>
                        </div>

                        <!-- Post Image -->
                        <div class="p-4 border-t border-gray-200">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-image h-5 w-5 text-gray-400 mr-2"></i>
                                <span class="text-gray-600 text-xs">Post Image</span>
                            </div>
                            <div class="mt-2">
                                <img src="https://via.placeholder.com/400x300?text=User+Post+Image" alt="Post Image" class="w-full rounded-md object-cover">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-4 space-y-2">
                            <button type="button" class="w-full flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-archive mr-2"></i>
                                Archive
                            </button>

                            <button type="button" class="w-full flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700" onclick="document.getElementById('deleteDialog').classList.add('show')">
                                <i class="fas fa-trash mr-2"></i>
                                Delete
                            </button>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="col-span-12 md:col-span-8 border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Section title -->
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <i class="fas fa-file-alt h-5 w-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">Post Content</h3>
                                <p class="text-xs text-gray-500">Full text of the user post</p>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="prose max-w-none text-sm">
                                <p>I've been using the RUBI app for about three months now, and I wanted to share my experience with other users.</p>

                                <p>First of all, the interface is very intuitive and easy to navigate. I particularly appreciate the dashboard that gives me a quick overview of my health metrics. The ability to track my daily activities has been a game-changer for my fitness routine.</p>

                                <p>One feature that stands out is the medication reminder. I used to forget to take my pills sometimes, but now with RUBI's notification system, I haven't missed a single dose. The app also allows me to record any side effects, which has been helpful during my doctor's appointments.</p>

                                <p>The community section is also great. I've connected with people who have similar health conditions, and we share tips and support each other. It's like having a support group in your pocket!</p>

                                <p>However, I think there's room for improvement. The app sometimes lags when uploading photos, and I wish there were more customization options for the reports. Also, it would be nice to have a dark mode for nighttime use.</p>

                                <p>Overall, I would rate RUBI 4.5/5 stars. It has significantly improved how I manage my health, and I would recommend it to anyone looking for a comprehensive health tracking app.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Comments (3)</h3>

                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-full">
                                <i class="fas fa-comments h-5 w-5"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="font-bold">User Comments</h3>
                                <p class="text-xs text-gray-500">Moderate comments on this post</p>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-200">
                            <!-- Comment 1 - Approved -->
                            <div class="p-4 hover:bg-gray-50" id="comment-1">
                                <div class="flex justify-between">
                                    <div class="flex items-center mb-2">
                                        <div class="font-medium text-sm">Jane Smith</div>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <div class="text-xs text-gray-500">16/04/2023 14:30</div>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <div class="text-xs text-green-600">
                                            Approved
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" onclick="document.getElementById('deleteCommentDialog-1').classList.add('show')" class="text-gray-600 hover:text-gray-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-sm pl-0 mt-1">
                                    Thanks for sharing your experience! I've been considering downloading RUBI, and your review was very helpful. I'm particularly interested in the medication reminder feature.
                                </div>
                            </div>

                            <!-- Comment 2 - Pending -->
                            <div class="p-4 hover:bg-gray-50" id="comment-2">
                                <div class="flex justify-between">
                                    <div class="flex items-center mb-2">
                                        <div class="font-medium text-sm">Mike Johnson</div>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <div class="text-xs text-gray-500">16/04/2023 15:45</div>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <div class="text-xs text-yellow-600">
                                            Pending
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        <button type="button" onclick="document.getElementById('deleteCommentDialog-2').classList.add('show')" class="text-gray-600 hover:text-gray-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-sm pl-0 mt-1">
                                    I've been using RUBI for 6 months now and I agree with most of your points. The community feature is really helpful. Have you tried connecting your fitness tracker? That's another great feature!
                                </div>
                            </div>

                            <!-- Comment 3 - Disapproved -->
                            <div class="p-4 hover:bg-gray-50" id="comment-3">
                                <div class="flex justify-between">
                                    <div class="flex items-center mb-2">
                                        <div class="font-medium text-sm">Alex Brown</div>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <div class="text-xs text-gray-500">17/04/2023 09:15</div>
                                        <span class="mx-2 text-gray-400">•</span>
                                        <div class="text-xs text-red-600">
                                            Disapproved
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" onclick="document.getElementById('deleteCommentDialog-3').classList.add('show')" class="text-gray-600 hover:text-gray-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-sm pl-0 mt-1">
                                    This app is terrible! I had so many issues with it. [Inappropriate content removed by moderator]
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Delete Post Confirmation Dialog -->
    <div class="dialog" id="deleteDialog">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Confirm Deletion</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Are you sure you want to delete this user post? This action cannot be undone.
                </p>
            </div>
            <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm" onclick="document.getElementById('deleteDialog').classList.remove('show')">
                    Cancel
                </button>
                <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Comment Dialogs -->
    <div class="dialog" id="deleteCommentDialog-1">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Confirm Comment Deletion</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Are you sure you want to delete this comment? This action cannot be undone.
                </p>
            </div>
            <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm" onclick="document.getElementById('deleteCommentDialog-1').classList.remove('show')">
                    Cancel
                </button>
                <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div class="dialog" id="deleteCommentDialog-2">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Confirm Comment Deletion</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Are you sure you want to delete this comment? This action cannot be undone.
                </p>
            </div>
            <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm" onclick="document.getElementById('deleteCommentDialog-2').classList.remove('show')">
                    Cancel
                </button>
                <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div class="dialog" id="deleteCommentDialog-3">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
            <div class="p-6">
                <h2 class="text-lg font-semibold">Confirm Comment Deletion</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Are you sure you want to delete this comment? This action cannot be undone.
                </p>
            </div>
            <div class="flex items-center justify-end gap-2 p-4 border-t border-gray-200">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm" onclick="document.getElementById('deleteCommentDialog-3').classList.remove('show')">
                    Cancel
                </button>
                <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <style>
        .dialog {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            align-items: center;
            justify-content: center;
        }

        .dialog.show {
            display: flex;
        }
    </style>

    <script>
        // Close dialogs when clicking outside
        document.querySelectorAll('.dialog').forEach(dialog => {
            dialog.addEventListener('click', (e) => {
                if (e.target === dialog) {
                    dialog.classList.remove('show');
                }
            });
        });
    </script>
@endsection
