<?php

namespace App\Models\Concerns;

/**
 * Laravel converts empty form inputs to null (ConvertEmptyStringsToNull).
 * The number columns below are NOT NULL (default 0), so an empty field must become 0
 * instead of breaking the save with a database error.
 */
trait NormalizesNumbers
{
    public function setSortOrderAttribute($value): void
    {
        $this->attributes['sort_order'] = (int) ($value ?? 0);
    }
}
