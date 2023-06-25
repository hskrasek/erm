<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function (Model $model): void {
            if (!empty($model->slug)) {
                return;
            }

            $model->slug = Str::snake($model->name);
        });
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: function (?string $slug, array $attributes): string {
                if ($slug !== null) {
                    return $slug;
                }

                return $this->slug = Str::snake($attributes['name']);
            }
        );
    }
}
