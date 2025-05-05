<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;

interface PostRepositoryInterface
{
    public function getPendingPosts($perPage = 10);
    public function getApprovedPosts($perPage = 10);
    public function getRejectedPosts($perPage = 10);
    public function getArchivedPosts($perPage = 10);
    public function getPostById($postId);
    public function getUserPosts($userId);
    public function createPost(array $postData);
    public function updatePost($postId, array $newDetails);
    public function deletePost($postId);
    public function approvePost($postId);
    public function rejectPost($postId);
    public function archivePost($postId);
    public function incrementViews($postId);
    public function getPaginatedUserPosts($userId, $status = null, $perPage = 9);
    public function storeMedia(UploadedFile $file);
}
