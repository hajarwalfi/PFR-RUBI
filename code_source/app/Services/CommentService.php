<?php

namespace App\Services;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getCommentsByPostId($postId)
    {
        return $this->commentRepository->getCommentsByPostId($postId);
    }

    public function getCommentById($commentId)
    {
        return $this->commentRepository->getCommentById($commentId);
    }

    public function createComment($postId, $content)
    {
        return $this->commentRepository->createComment([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'content' => $content,
        ]);
    }

    public function updateComment($commentId, $content)
    {
        return $this->commentRepository->updateComment($commentId, [
            'content' => $content,
        ]);
    }

    public function deleteComment($commentId)
    {
        return $this->commentRepository->deleteComment($commentId);
    }
}
