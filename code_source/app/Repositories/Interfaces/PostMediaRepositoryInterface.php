<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;

interface PostMediaRepositoryInterface
{
    public function getMediaByPostId($postId);
    public function getMediaById($mediaId);
    public function createMedia($postId, UploadedFile $file, $type);
    public function deleteMedia($mediaId);
}
