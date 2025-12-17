<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryImage extends Model
{
    protected $table = 'history_images';
    protected $fillable = ['about_page_id', 'image_path'];

    public function aboutPage()
    {
        return $this->belongsTo(AboutPage::class);
    }
}
