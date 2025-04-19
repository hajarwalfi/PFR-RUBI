<?php


namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function getCommentsByPostId($postId);

    public function getCommentById($commentId);

    public function createComment(array $commentData);

    public function updateComment($commentId, array $newDetails);

    public function deleteComment($commentId);
}
