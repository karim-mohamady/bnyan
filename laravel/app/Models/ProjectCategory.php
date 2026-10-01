<?php

namespace App\Models;

use App\Models\Concerns\NormalizesNumbers;
use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    use NormalizesNumbers;
    protected $fillable = ['key', 'label', 'sort_order'];
}
