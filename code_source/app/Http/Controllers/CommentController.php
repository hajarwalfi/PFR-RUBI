<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $commentService;
    protected $postService;

    public function __construct(CommentService $commentService, PostService $postService)
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
    }

    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = $this->postService->getPostById($postId);

        if ($post->status !== 'approved') {
            abort(403, 'You cannot comment on this post.');
        }

        $this->commentService->createComment($postId, $request->content);

        return back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $this->commentService->getCommentById($commentId);

        // Only allow editing of own comments
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this comment.');
        }

        $this->commentService->updateComment($commentId, $request->content);

        return back()->with('success', 'Comment updated successfully.');
    }

    public function destroy($commentId)
    {
        $comment = $this->commentService->getCommentById($commentId);

        $this->commentService->deleteComment($commentId);

        return back()->with('success', 'Comment deleted successfully.');
    }
}
