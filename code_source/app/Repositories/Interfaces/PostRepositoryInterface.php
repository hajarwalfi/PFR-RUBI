<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPendingPosts();
    public function getApprovedPosts();
    public function getRejectedPosts();
    public function getArchivedPosts();
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
}
