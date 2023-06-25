<?php

namespace App\Models;

use App\Models\Concerns;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin IdeHelperInstance
 */
class Instance extends Model
{
    use Concerns\HasPublicIdentifier;
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

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function parent(): BelongsToMany
    {
        return $this->belongsToMany(
            related: self::class,
            table: 'relation',
            foreignPivotKey: 'child_instance_id',
            relatedPivotKey: 'parent_instance_id',
            parentKey: 'id',
            relatedKey: 'id'
        )
            ->using(Relation::class)
            ->withPivot(['relationship_id'])
            ->as('parent')
            ->withTimestamps()
            ->limit(1);
    }

    public function children(): BelongsToMany
    {
        return $this->belongsToMany(
            related: self::class,
            table: 'relation',
            foreignPivotKey: 'parent_instance_id',
            relatedPivotKey: 'child_instance_id',
            parentKey: 'id',
            relatedKey: 'id'
        )
            ->using(Relation::class)
            ->withPivot(['relationship_id'])
            ->as('children')
            ->withTimestamps();
    }
}
