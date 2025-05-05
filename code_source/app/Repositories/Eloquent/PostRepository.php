<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{

    public function getPendingPosts($perPage=10)
    {
        return Post::with(['user'])->pending()->latest()->paginate($perPage);
    }

    public function getApprovedPosts($perPage=10)
    {
        return Post::with(['user'])->approved()->latest()->paginate($perPage);
    }

    public function getRejectedPosts($perPage=10)
    {
        return Post::with(['user'])->rejected()->latest()->paginate($perPage);
    }

    public function getArchivedPosts($perPage=10)
    {
        return Post::with(['user'])->archived()->latest()->paginate($perPage);
    }

    public function getPostById($postId)
    {
        return Post::with(['user', 'comments.user'])->findOrFail($postId);
    }

    public function getUserPosts($userId)
    {
        return Post::where('user_id', $userId)->latest()->get();
    }

    public function createPost(array $postData)
    {
        try {
            Log::info('Creating post in repository', [
                'user_id' => $postData['user_id'],
                'has_title' => isset($postData['title']),
                'has_media' => isset($postData['media']) && !empty($postData['media']),
                'media_count' => isset($postData['media']) ? count($postData['media']) : 0
            ]);

            return Post::create($postData);
        } catch (\Exception $e) {
            Log::error('Error in createPost repository method', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function updatePost($postId, array $newDetails)
    {
        return Post::whereId($postId)->update($newDetails);
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);

        if (!empty($post->media)) {
            foreach ($post->media as $media) {
                if (isset($media['path']) && Storage::disk('public')->exists($media['path'])) {
                    Storage::disk('public')->delete($media['path']);
                }
            }
        }

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

    public function getPaginatedUserPosts($userId, $status = null, $perPage = 9)
    {
        $query = Post::with(['comments'])
            ->where('user_id', $userId);

        if ($status) {
            $query->where('status', $status);
        }

        return $query->latest()->paginate($perPage);
    }

    public function storeMedia(UploadedFile $file)
    {
        try {
            Log::info('Storing media file in repository', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize()
            ]);

            // Create a unique folder for each upload to avoid filename collisions
            $path = $file->store('post-media/' . Str::random(10), 'public');

            Log::info('File stored successfully', ['path' => $path]);

            return [
                'path' => $path,
                'type' => $this->determineFileType($file),
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ];
        } catch (\Exception $e) {
            Log::error('Error storing media file in repository', [
                'exception' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    protected function determineFileType(UploadedFile $file)
    {
        $mimeType = $file->getMimeType();

        if (strpos($mimeType, 'image/') === 0) {
            return 'image';
        } elseif (strpos($mimeType, 'video/') === 0) {
            return 'video';
        }
        return 'other';
    }
}
