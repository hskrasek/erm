<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperInstance
 */
class Instance extends Model
{
    use HasFactory;

    protected $casts = [
        'attributes' => AsArrayObject::class,
    ];

    protected $fillable = [
        'ulid', 'attributes'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function entity(): HasOne
    {
        return $this->hasOne(Entity::class);
    }
}
