<?php

namespace App\Http\Resources;

use App\Models\Instance;
use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @mixin Instance
 * @mixin Relation
 */
class RelationResource extends JsonResource
{
    private string $direction;

    public function withDirection(string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Collection<Instance> $relations */
        $relations = $this->resource;

        return $relations->mapToGroups(function (Instance $instance) {
            return [$this->relationshipName($instance) => InstanceResource::make($instance->unsetRelation($this->direction))];
        })->all();
    }

    private function relationshipName(Instance $instance): string
    {
        if ($this->direction === 'parent') {
            return $instance->entity->slug;
        }

        return $instance->{$this->direction}->relationship->name;
    }
}
