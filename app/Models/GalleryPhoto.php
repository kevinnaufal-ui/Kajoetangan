<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'uploader_name', 'uploader_email', 'image_url', 'caption', 'status', 'rejection_reason', 'total_likes', 'deletion_requested', 'deletion_request_reason', 'deleted_by_admin', 'deletion_reason'
    ];
}
