<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\PostMediaRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService
{
    protected $postRepository;
    public $postMediaRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        PostMediaRepositoryInterface $postMediaRepository
    ) {
        $this->postRepository = $postRepository;
        $this->postMediaRepository = $postMediaRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

    public function getPendingPosts()
    {
        return $this->postRepository->getPendingPosts();
    }

    public function getApprovedPosts()
    {
        return $this->postRepository->getApprovedPosts();
    }

    public function getRejectedPosts()
    {
        return $this->postRepository->getRejectedPosts();
    }

    public function getArchivedPosts()
    {
        return $this->postRepository->getArchivedPosts();
    }

    public function getPostById($postId)
    {
        return $this->postRepository->getPostById($postId);
    }

    public function getUserPosts($userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->postRepository->getUserPosts($userId);
    }

    public function createPost($content, $files = [])
    {
        DB::beginTransaction();

        try {
            $post = $this->postRepository->createPost([
                'user_id' => Auth::id(),
                'content' => $content,
                'status' => 'pending',
            ]);

            if (!empty($files)) {
                foreach ($files as $file) {
                    $type = $this->determineFileType($file);
                    $this->postMediaRepository->createMedia($post->id, $file, $type);
                }
            }

            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePost($postId, $content)
    {
        return $this->postRepository->updatePost($postId, [
            'content' => $content,
            'status' => 'pending', // Reset to pending for re-moderation
        ]);
    }

    public function deletePost($postId)
    {
        return $this->postRepository->deletePost($postId);
    }

    public function approvePost($postId)
    {
        return $this->postRepository->approvePost($postId);
    }

    public function rejectPost($postId)
    {
        return $this->postRepository->rejectPost($postId);
    }

    public function archivePost($postId)
    {
        return $this->postRepository->archivePost($postId);
    }

    public function addMediaToPost($postId, UploadedFile $file)
    {
        $type = $this->determineFileType($file);
        return $this->postMediaRepository->createMedia($postId, $file, $type);
    }

    protected function determineFileType(UploadedFile $file)
    {
        $mimeType = $file->getMimeType();

        if (strpos($mimeType, 'image/') === 0) {
            return 'image';
        } elseif (strpos($mimeType, 'video/') === 0) {
            return 'video';
        }

        // Default to image if can't determine
        return 'image';
    }
    public function incrementViews($postId)
    {
        return $this->postRepository->incrementViews($postId);
    }
}
