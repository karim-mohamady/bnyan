<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    public $timestamps = false;
    protected $fillable = ['page', 'key', 'value', 'updated_at'];
    protected $casts = [
        'value' => 'json',
        'updated_at' => 'datetime',
    ];

    public static function getPageContent(string $page): array
    {
        return static::where('page', $page)
            ->pluck('value', 'key')
            ->toArray();
    }

    public static function setField(string $page, string $key, $value): self
    {
        return static::updateOrCreate(
            ['page' => $page, 'key' => $key],
            ['value' => $value, 'updated_at' => now()]
        );
    }
}
