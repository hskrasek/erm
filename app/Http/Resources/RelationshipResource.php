<?php

namespace App\Http\Resources;

use App\Models\Relationship;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Relationship
 */
class RelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource
            ->mapWithKeys(function (Relationship $relationship): array {
                return [
                    $relationship->name => [
                        'entity' => EntityResource::make($relationship->childEntity),
                        'minimum' => $relationship->minimum->name,
                        'maximum' => $relationship->maximum->name,
                    ],
                ];
            })
            ->all();
    }
}
