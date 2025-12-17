<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryLike extends Model
{
    protected $fillable = ['photo_id','ip_address'];
}
