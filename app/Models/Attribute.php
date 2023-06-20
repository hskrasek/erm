<?php

namespace App\Models;

use App\Models\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAttribute
 */
class Attribute extends Model
{
    use Concerns\HasPublicIdentifier;
    use Concerns\HasSlug;
    use HasFactory;

    protected $fillable = [
        'ulid', 'name', 'slug'
    ];
}
