<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getCommentsByPostId($postId)
    {
        return Comment::with('user')->where('post_id', $postId)->latest()->get();
    }

    public function getCommentById($commentId)
    {
        return Comment::with('user')->findOrFail($commentId);
    }

    public function createComment(array $commentData)
    {
        return Comment::create($commentData);
    }

    public function updateComment($commentId, array $newDetails)
    {
        return Comment::whereId($commentId)->update($newDetails);
    }

    public function deleteComment($commentId)
    {
        return Comment::destroy($commentId);
    }
}
