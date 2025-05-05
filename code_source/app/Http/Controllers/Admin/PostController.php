<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('admin');
    }

    /**
     * Affiche tous les posts pour l'administration
     */
    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('Admin.Posts.index', compact('posts'));
    }

    /**
     * Affiche un post spécifique pour l'administration
     */
    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return view('Admin.Posts.show', compact('post'));
    }

    /**
     * Supprime un post
     */
    public function destroy($id)
    {
        $this->postService->deletePost($id);
        return redirect()->route('admin.posts.moderation')
            ->with('success', 'Post deleted successfully.');
    }

    /**
     * Tableau de bord de modération
     */
    /**
     * Tableau de bord de modération
     */
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
            $selectedPost = $posts->first();
        }

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
     * Approuve un post
     */
    public function approve($id)
    {
        $this->postService->approvePost($id);
        return redirect()->back()
            ->with('success', 'Post approved successfully.');
    }

    /**
     * Rejette un post
     */
    public function reject($id)
    {
        $this->postService->rejectPost($id);
        return redirect()->back()
            ->with('success', 'Post rejected successfully.');
    }

    /**
     * Archive un post
     */
    public function archive($id)
    {
        $this->postService->archivePost($id);
        return redirect()->back()
            ->with('success', 'Post archived successfully.');
    }
}
