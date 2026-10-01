<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssemblyMember extends Model
{
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
