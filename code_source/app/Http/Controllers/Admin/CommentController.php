<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('admin');
    }

    public function destroy($commentId)
    {
        $this->commentService->deleteComment($commentId);
        return back()->with('success', 'Comment deleted successfully.');
    }
}
