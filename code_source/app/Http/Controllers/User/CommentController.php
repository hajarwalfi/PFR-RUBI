<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $commentService;
    protected $postService;

    public function __construct(CommentService $commentService, PostService $postService)
    {
        $this->commentService = $commentService;
        $this->postService = $postService;
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:500',
            'post_id' => 'required|exists:posts,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $post = $this->postService->getPostById($request->input('post_id'));

            if ($post->status !== 'approved' && $post->user_id !== Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You cannot comment on this post.');
            }

            $this->commentService->createComment(
                $request->input('post_id'),
                $request->input('content')
            );

            return redirect()->back()
                ->with('success', 'Your comment has been posted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while posting your comment. Please try again.')
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $comment = $this->commentService->getCommentById($id);

            if ($comment->user_id !== Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You are not authorized to edit this comment.');
            }

            return view('User.Community.edit-comment', compact('comment'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Comment not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $comment = $this->commentService->getCommentById($id);

            if (!$comment) {
                return redirect()->back()->with('error', 'Comment not found.');
            }

            if ($comment->user_id !== Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You are not authorized to update this comment.');
            }

            $this->commentService->updateComment($id, $request->input('content'));

            return redirect()->route('user.community.show', $comment->post_id)
                ->with('success', 'Your comment has been updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating your comment. Please try again.')
                ->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            $comment = $this->commentService->getCommentById($id);

            if ($comment->user_id !== Auth::id()) {
                return redirect()->back()
                    ->with('error', 'You are not authorized to delete this comment.');
            }

            $postId = $comment->post_id;
            $this->commentService->deleteComment($id);

            return redirect()->route('user.community.show', $postId)
                ->with('success', 'Your comment has been deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while deleting your comment. Please try again.');
        }
    }
    public function myComments(Request $request)
    {
        $query = Comment::with(['post', 'post.user'])
            ->where('user_id', Auth::id());

        $comments = $query->paginate(10);

        return view('User.Dashboard.comments', compact('comments'));
    }
}
