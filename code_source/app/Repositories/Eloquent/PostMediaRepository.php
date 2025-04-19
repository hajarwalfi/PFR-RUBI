<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\PostMediaRepositoryInterface;
use App\Models\PostMedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PostMediaRepository implements PostMediaRepositoryInterface
{
    public function getMediaByPostId($postId)
    {
        return PostMedia::where('post_id', $postId)->get();
    }

    public function getMediaById($mediaId)
    {
        return PostMedia::findOrFail($mediaId);
    }

    public function createMedia($postId, UploadedFile $file, $type)
    {
        $path = $file->store('post-media', 'public');

        return PostMedia::create([
            'post_id' => $postId,
            'type' => $type,
            'path' => $path,
        ]);
    }

    public function deleteMedia($mediaId)
    {
        $media = PostMedia::findOrFail($mediaId);

        // Delete the file from storage
        if (Storage::disk('public')->exists($media->path)) {
            Storage::disk('public')->delete($media->path);
        }

        return $media->delete();
    }
}
