<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::with(['user', 'media'])->latest()->get();
    }

    public function getPendingPosts()
    {
        return Post::with(['user', 'media'])->pending()->latest()->get();
    }

    public function getApprovedPosts()
    {
        return Post::with(['user', 'media'])->approved()->latest()->get();
    }

    public function getRejectedPosts()
    {
        return Post::with(['user', 'media'])->rejected()->latest()->get();
    }

    public function getArchivedPosts()
    {
        return Post::with(['user', 'media'])->archived()->latest()->get();
    }

    public function getPostById($postId)
    {
        return Post::with(['user', 'media', 'comments.user'])->findOrFail($postId);
    }

    public function getUserPosts($userId)
    {
        return Post::with(['media'])->where('user_id', $userId)->latest()->get();
    }

    public function createPost(array $postData)
    {
        return Post::create($postData);
    }

    public function updatePost($postId, array $newDetails)
    {
        return Post::whereId($postId)->update($newDetails);
    }

    public function deletePost($postId)
    {
        return Post::destroy($postId);
    }

    public function approvePost($postId)
    {
        return Post::whereId($postId)->update([
            'status' => 'approved',
            'moderated_at' => Carbon::now(),
        ]);
    }

    public function rejectPost($postId)
    {
        return Post::whereId($postId)->update([
            'status' => 'rejected',
            'moderated_at' => Carbon::now(),
        ]);
    }

    public function archivePost($postId)
    {
        return Post::whereId($postId)->update([
            'status' => 'archived',
            'moderated_at' => Carbon::now(),
        ]);
    }

    public function incrementViews($postId)
    {
        $post = Post::findOrFail($postId);
        $post->increment('views');
        return $post->views;
    }
}
