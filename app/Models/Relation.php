<?php

namespace App\Models;

use App\Models\Concerns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @mixin IdeHelperRelation
 */
class Relation extends Pivot
{
    use Concerns\HasPublicIdentifier;

    public $incrementing = true;

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class);
    }
}
