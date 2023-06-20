<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use App\Models\Entity;
use App\OpenApi\RequestBodies\CreateAttributeRequestBody;
use App\OpenApi\Responses\AttributeResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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
    #[OpenAPI\RequestBody(factory: CreateAttributeRequestBody::class)]
    #[OpenAPI\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    #[OpenAPI\Response(factory: AttributeResponse::class, statusCode: 201)]
    public function __invoke(AddAttributeRequest $request, Entity $entity): JsonResponse
    {
        /** @var Attribute $attribute */
        $attribute = $entity->attributes()
            ->create([
                'name' => $request->input('name'),
            ]);

        return (new AttributeResource($attribute))
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
