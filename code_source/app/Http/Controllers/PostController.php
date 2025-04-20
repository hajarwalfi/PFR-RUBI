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

    public function index()
    {
        $posts = $this->postService->getApprovedPosts();
        return view('Admin.Posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

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


    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        // Only show approved posts to regular users
        if ($post->status !== 'approved' && !Auth::user()->hasRole('admin')) {
            abort(403, 'This post is not available.');
        }

        return view('posts.show', compact('post'));
    }


    public function edit($id)
    {
        $post = $this->postService->getPostById($id);

        // Only allow editing of own posts
        if ($post->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'You are not authorized to edit this post.');
        }

        return view('posts.edit', compact('post'));
    }


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


    public function destroy($id)
    {
        $post = $this->postService->getPostById($id);


        $this->postService->deletePost($id);

        return redirect()->route('moderation')
            ->with('success', 'Post deleted successfully.');
    }


    public function myPosts()
    {
        $posts = $this->postService->getUserPosts();
        return view('posts.my-posts', compact('posts'));
    }


    public function removeMedia($mediaId)
    {
        $this->postService->removeMediaFromPost($mediaId);
        return back()->with('success', 'Media removed successfully.');
    }


    public function moderationDashboard(Request $request)
    {
        $status = $request->query('status', 'pending');

        // Get posts based on status
        switch ($status) {
            case 'approved':
                $posts = $this->postService->getApprovedPosts();
                break;
            case 'rejected':
                $posts = $this->postService->getRejectedPosts();
                break;
            case 'archived':
                $posts = $this->postService->getArchivedPosts();
                break;
            case 'pending':
            default:
                $posts = $this->postService->getPendingPosts();
                $status = 'pending';
                break;
        }

        $pendingCount = $this->postService->getPendingPosts()->count();
        $approvedCount = $this->postService->getApprovedPosts()->count();
        $rejectedCount = $this->postService->getRejectedPosts()->count();
        $archivedCount = $this->postService->getArchivedPosts()->count();

        $selectedPost = null;
        if ($request->has('post_id')) {
            $selectedPost = $this->postService->getPostById($request->query('post_id'));
        } else if ($posts->count() > 0) {
            // Default to the first post in the list
            $selectedPost = $posts->first();
        }

        // Change the view to 'Admin.Posts.moderation' to match your blade file
        return view('Admin.Posts.index', compact(
            'posts',
            'selectedPost',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'archivedCount',
            'status'
        ));
    }

    /**
     * Approve a post.
     */
    public function approve($id)
    {
        $this->postService->approvePost($id);
        $post = $this->postService->getPostById($id);

        // Redirect back to moderation with the current status
        return redirect()->route('moderation', ['status' => 'approved'])
            ->with('success', 'Post approved successfully.');
    }

    /**
     * Reject a post.
     */
    public function reject($id)
    {
        $this->postService->rejectPost($id);
        $post = $this->postService->getPostById($id);

        // Redirect back to moderation with the current status
        return redirect()->route('moderation', ['status' => 'rejected'])
            ->with('success', 'Post rejected successfully.');
    }

    /**
     * Archive a post.
     */
    public function archive($id)
    {
        $this->postService->archivePost($id);
        $post = $this->postService->getPostById($id);

        // Redirect back to moderation with the current status
        return redirect()->route('moderation', ['status' => 'archived'])
            ->with('success', 'Post archived successfully.');
    }
}
