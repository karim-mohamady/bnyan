<?php

namespace App\Models;

use App\Models\Concerns\NormalizesNumbers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardMember extends Model
{
    use NormalizesNumbers;
    use SoftDeletes;

    protected $fillable = [
        'role',
        'role_label',
        'name',
        'description',
        'is_featured',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];
}
