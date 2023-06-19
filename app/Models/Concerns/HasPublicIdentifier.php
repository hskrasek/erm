<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Hidehalo\Nanoid\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @mixin Model
 */
trait HasPublicIdentifier
{
    public static function bootHasPublicIdentifier(): void
    {
        static::creating(function(Model $model): void {
            if (!empty($model->ulid)) {
                return;
            }

            static $nano = new Client(size: 22);

            $model->ulid = $this->identifierPrefix() . '_' . $nano->generateId(mode: Client::MODE_DYNAMIC);
        });
    }

    private function identifierPrefix(): string
    {
        if (defined(static::PUBLIC_IDENTIFIER_PREFIX)) {
            return static::PUBLIC_IDENTIFIER_PREFIX;
        }

        return Str::of(class_basename(static::class))->lower()->limit(3, '')->toString();
    }
}
