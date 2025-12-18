<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'event_date', 'location', 'address', 'map_embed_url', 'image_url'];
    
    protected $casts = [
        'event_date' => 'datetime',
    ];
}
