<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use App\Models\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Vyuldashev\LaravelOpenApi\Attributes as OpenAPI;

#[OpenAPI\PathItem()]
class AddAttributes extends Controller
{

    /**
     * @param AddAttributeRequest $request
     * @param Entity $entity
     * @return JsonResponse
     */
    #[OpenAPI\Operation()]
    public function __invoke(AddAttributeRequest $request, Entity $entity): JsonResponse
    {
        /** @var Attribute $attribute */
        $attribute = $entity->attributes()
            ->create([
                'ulid' => Str::ulid(now()),
                'name' => $request->input('name'),
            ]);

        return (new AttributeResource($attribute))
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
