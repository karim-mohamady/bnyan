<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'action',
        'entity',
        'entity_id',
        'summary',
        'ip',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static function log(string $action, string $entity, ?int $entityId, string $summary): self
    {
        return static::create([
            'action' => $action,
            'entity' => $entity,
            'entity_id' => $entityId,
            'summary' => $summary,
            'ip' => request()->ip(),
            'created_at' => now(),
        ]);
    }
}
