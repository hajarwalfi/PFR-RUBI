<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
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

    public function createPost($title, $content, $files = [])
    {
        DB::beginTransaction();

        try {
            Log::info('Starting post creation in service', [
                'user_id' => Auth::id(),
                'title' => $title,
                'content_length' => strlen($content),
                'files_count' => count($files)
            ]);

            // Process media files
            $mediaItems = [];
            if (!empty($files)) {
                foreach ($files as $index => $file) {
                    Log::info('Processing file', [
                        'index' => $index,
                        'is_valid' => $file->isValid(),
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize()
                    ]);

                    if ($file->isValid()) {
                        try {
                            $mediaItem = $this->postRepository->storeMedia($file);
                            Log::info('Media stored successfully', ['media_item' => $mediaItem]);
                            $mediaItems[] = $mediaItem;
                        } catch (\Exception $e) {
                            Log::error('Error storing media file', [
                                'exception' => $e->getMessage(),
                                'file' => $file->getClientOriginalName()
                            ]);
                            throw $e;
                        }
                    } else {
                        Log::warning('Invalid file uploaded', [
                            'error' => $file->getError(),
                            'error_message' => $file->getErrorMessage()
                        ]);
                    }
                }
            }

            Log::info('Creating post with media', [
                'media_count' => count($mediaItems)
            ]);

            // Create post with media
            $post = $this->postRepository->createPost([
                'user_id' => Auth::id(),
                'title' => $title,
                'content' => $content,
                'status' => 'pending',
                'media' => !empty($mediaItems) ? $mediaItems : null,
                'views' => 0,
            ]);

            Log::info('Post created successfully', ['post_id' => $post->id]);

            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating post: ' . $e->getMessage(), [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function updatePost($postId, $title, $content)
    {
        try {
            // Get existing post
            $post = $this->postRepository->getPostById($postId);

            // Update only text content
            return $this->postRepository->updatePost($postId, [
                'title' => $title,
                'content' => $content,
                'status' => 'pending', // Reset to pending for moderation
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage(), [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'post_id' => $postId
            ]);
            throw $e;
        }
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

    public function incrementViews($postId)
    {
        return $this->postRepository->incrementViews($postId);
    }

    public function getPaginatedUserPosts($userId = null, $status = null, $perPage = 9)
    {
        $userId = $userId ?? Auth::id();
        return $this->postRepository->getPaginatedUserPosts($userId, $status, $perPage);
    }
}
