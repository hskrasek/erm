<?php

namespace App\Models;

use App\Models\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperEntity
 */
class Entity extends Model
{
    use Concerns\HasPublicIdentifier;
    use Concerns\HasSlug;
    use HasFactory;

    protected $fillable = [
        'ulid', 'name', 'description', 'slug'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function instances(): HasMany
    {
        return $this->hasMany(Instance::class);
    }
}
