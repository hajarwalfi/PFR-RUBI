@extends('User.layouts.aside')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="mb-12">
                <h1 class="font-serif text-3xl mb-2 text-red-800">My Comments</h1>
                <p class="text-gray-600 text-sm">Manage your interactions and track your contributions</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
                    <p class="text-sm">{!! session('success') !!}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            @endif

            @if($comments->count() > 0)
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-red-100">
                        <thead class="bg-red-50 font-bold">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">
                                Post
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">
                                Comment
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-red-800 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-red-50">
                        @foreach($comments as $comment)
                            <tr class="hover:bg-red-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-red-800">
                                        <a href="{{ route('user.community.show', $comment->post_id) }}" class="hover:text-red-600">
                                            {{ Str::limit($comment->post->title ?? 'Post #' . $comment->post_id, 30) }}
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">
                                        {{ Str::limit($comment->content, 60) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ $comment->created_at->format('m/d/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('user.community.show', $comment->post_id) }}" class="text-red-600 hover:text-red-800" title="View Post">
                                            <i class="fas fa-eye"></i>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="my-8 flex justify-center">
                    {{ $comments->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-red-50 rounded-lg border border-red-100">
                    <i class="fas fa-comment text-red-300 text-4xl"></i>
                    <h3 class="mt-4 text-lg font-medium text-red-800">No comments found</h3>
                    <p class="mt-1 text-sm text-red-600">You haven't commented on any posts yet.</p>
                    <div class="mt-6">
                        <a href="{{ route('user.community.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Explore Posts
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
