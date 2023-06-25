<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Hidehalo\Nanoid\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasPublicIdentifier
{
    public static function bootHasPublicIdentifier(): void
    {
        static::creating(function(Model $model): void {
            if (!empty($model->ulid)) {
                return;
            }

            static $nano = new Client(size: 22);

            $model->ulid = self::identifierPrefix() . '_' . $nano->formattedId(
                alphabet: '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
                );
        });
    }

    private static function identifierPrefix(): string
    {
        if (defined('static::PUBLIC_IDENTIFIER_PREFIX')) {
            return static::PUBLIC_IDENTIFIER_PREFIX;
        }

        return Str::of(class_basename(static::class))->lower()->limit(3, '')->toString();
    }
}
