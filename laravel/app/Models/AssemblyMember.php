<?php

namespace App\Models;

use App\Models\Concerns\NormalizesNumbers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssemblyMember extends Model
{
    use NormalizesNumbers;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'role',
        'city',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];
}
