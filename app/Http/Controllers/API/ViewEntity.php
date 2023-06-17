<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenAPI;

#[OpenAPI\PathItem]
class ViewEntity extends Controller
{
    /**
     * View an entity
     *
     * @param Request $request
     * @param Entity $entity
     * @return EntityResource
     */
    #[OpenAPI\Operation()]
    public function __invoke(Request $request, Entity $entity): EntityResource
    {
        return new EntityResource($entity->load('attributes', 'author'));
    }
}
