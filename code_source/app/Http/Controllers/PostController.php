<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;

        // Apply admin middleware only to admin methods
//        $this->middleware('role:admin')->only([
//            'pendingPosts', 'approvedPosts', 'rejectedPosts', 'archivedPosts',
//            'approve', 'reject', 'archive', 'adminShow'
//        ]);
    }

    /**
     * Display a listing of approved posts.
     */
    public function index()
    {
        $posts = $this->postService->getApprovedPosts();
        return view('Admin.Posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB max
        ]);

        // Ensure at least content or media is provided
        if (empty($request->content) && !$request->hasFile('media')) {
            return back()->withErrors(['message' => 'Please provide content or media for your post.']);
        }

        $post = $this->postService->createPost(
            $request->content,
            $request->file('media') ?? []
        );

        return redirect()->route('posts.myPosts')
            ->with('success', 'Post created successfully and is pending approval.');
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        // Only show approved posts to regular users
        if ($post->status !== 'approved' && !Auth::user()->hasRole('admin')) {
            abort(403, 'This post is not available.');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        // Only allow editing of own posts
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'You are not authorized to edit this post.');
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = $this->postService->getPostById($id);

        // Only allow editing of own posts
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'You are not authorized to edit this post.');
        }

        $request->validate([
            'content' => 'nullable|string',
            'media.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB max
        ]);

        $this->postService->updatePost($id, $request->content);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $this->postService->addMediaToPost($id, $file);
            }
        }

        return redirect()->route('posts.myPosts')
            ->with('success', 'Post updated successfully and is pending approval.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = $this->postService->getPostById($id);

        // Only allow deletion of own posts or by admin
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'You are not authorized to delete this post.');
        }

        $this->postService->deletePost($id);

        return redirect()->route('posts.myPosts')
            ->with('success', 'Post deleted successfully.');
    }

    /**
     * Display a listing of the user's posts.
     */
    public function myPosts()
    {
        $posts = $this->postService->getUserPosts();
        return view('posts.my-posts', compact('posts'));
    }

    /**
     * Remove media from a post.
     */
    public function removeMedia($mediaId)
    {
        $this->postService->removeMediaFromPost($mediaId);
        return back()->with('success', 'Media removed successfully.');
    }

    /**
     * ADMIN METHODS
     */

    /**
     * Display a listing of pending posts.
     */
    public function pendingPosts()
    {
        $posts = $this->postService->getPendingPosts();
        return view('admin.posts.pending', compact('posts'));
    }

    /**
     * Display a listing of approved posts.
     */
    public function approvedPosts()
    {
        $posts = $this->postService->getApprovedPosts();
        return view('admin.posts.approved', compact('posts'));
    }

    /**
     * Display a listing of rejected posts.
     */
    public function rejectedPosts()
    {
        $posts = $this->postService->getRejectedPosts();
        return view('admin.posts.rejected', compact('posts'));
    }

    /**
     * Display a listing of archived posts.
     */
    public function archivedPosts()
    {
        $posts = $this->postService->getArchivedPosts();
        return view('admin.posts.archived', compact('posts'));
    }

    /**
     * Show a specific post for moderation.
     */
    public function adminShow($id)
    {
        $post = $this->postService->getPostById($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Approve a post.
     */
    public function approve($id)
    {
        $this->postService->approvePost($id);
        return redirect()->route('posts.pending')
            ->with('success', 'Post approved successfully.');
    }

    /**
     * Reject a post.
     */
    public function reject($id)
    {
        $this->postService->rejectPost($id);
        return redirect()->route('posts.pending')
            ->with('success', 'Post rejected successfully.');
    }

    /**
     * Archive a post.
     */
    public function archive($id)
    {
        $this->postService->archivePost($id);
        return redirect()->route('posts.pending')
            ->with('success', 'Post archived successfully.');
    }
}
