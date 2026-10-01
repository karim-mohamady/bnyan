<?php

namespace App\Models;

use App\Models\Concerns\NormalizesNumbers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    use NormalizesNumbers;
    protected $fillable = [
        'project_id',
        'type', // image | video
        'source', // upload | url
        'url',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
