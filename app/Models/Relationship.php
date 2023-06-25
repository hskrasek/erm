<?php

namespace App\Models;

use App\Enum\Cardinality;
use App\Models\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperRelationship
 */
class Relationship extends Model
{
    use Concerns\HasPublicIdentifier;
    use HasFactory;

    protected $casts = [
        'minimum' => Cardinality::class,
        'maximum' => Cardinality::class,
    ];

    protected $fillable = [
        'name', 'minimum', 'maximum'
    ];

    public function parentEntity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function childEntity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }
}
