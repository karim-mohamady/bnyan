<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    protected $table = 'media_library';

    protected $fillable = [
        'disk',
        'path',
        'original_name',
        'mime',
        'size',
        'width',
        'height',
    ];

    public function getUrlAttribute(): string
    {
        return url('storage/' . ltrim($this->path, '/'));
    }
}
