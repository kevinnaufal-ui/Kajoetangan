<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = ['section','content'];
    public $timestamps = true;
    public function historyImages()
    {
        return $this->hasMany(\App\Models\HistoryImage::class);
    }
}
