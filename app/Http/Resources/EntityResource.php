<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Entity
 */
class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ulid,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            'author' => UserResource::make($this->whenLoaded('author')),
            'relationships' => RelationshipResource::make($this->whenLoaded('relationships')),
        ];
    }
}
