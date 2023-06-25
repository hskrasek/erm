<?php

namespace App\Http\Resources;

use App\Models\Instance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Instance
 */
class InstanceResource extends JsonResource
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
            'type' => $this->entity->slug,
            'data' => $this->attributes,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'children' => RelationResource::make($this->whenLoaded('children', $this->children))->withDirection('children'),
            'parent' => RelationResource::make($this->whenLoaded('parent'))->withDirection('parent'),
        ];
    }
}
