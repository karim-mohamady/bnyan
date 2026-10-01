<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GovernanceDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category',
        'icon',
        'title',
        'description',
        'button_label',
        'tag',
        'file_path',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) return null;
        if (str_starts_with($this->file_path, 'http')) return $this->file_path;
        return url('storage/' . ltrim($this->file_path, '/'));
    }
}
