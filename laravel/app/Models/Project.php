<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'desc',
        'long_desc',
        'category',
        'tag',
        'tag_class',
        'color',
        'target',
        'required_amount',
        'collected_amount',
        'progress_percent',
        'is_done',
        'is_published',
        'is_featured',
        'featured_order',
        'sort_order',
    ];

    protected $casts = [
        'is_done' => 'boolean',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'required_amount' => 'integer',
        'collected_amount' => 'integer',
        'progress_percent' => 'integer',
        'featured_order' => 'integer',
        'sort_order' => 'integer',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('sort_order');
    }

    public function images(): HasMany
    {
        return $this->media()->where('type', 'image');
    }

    public function videos(): HasMany
    {
        return $this->media()->where('type', 'video');
    }

    public function getReqAttribute(): int
    {
        return (int) $this->required_amount;
    }

    public function getRemAttribute(): int
    {
        $rem = $this->required_amount - $this->collected_amount;
        return max(0, (int) $rem);
    }

    public function getPctAttribute(): int
    {
        if ($this->progress_percent !== null) {
            return (int) $this->progress_percent;
        }

        if ($this->required_amount <= 0) {
            return 0;
        }

        return (int) min(100, round(($this->collected_amount / $this->required_amount) * 100));
    }
}
