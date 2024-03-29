<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEntityRequest;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use App\Models\Team;
use App\Models\User;
use App\OpenApi\RequestBodies\CreateEntityRequestBody;
use App\OpenApi\Responses\EntityResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenAPI;

#[OpenAPI\PathItem()]
class CreateEntity extends Controller
{
    /**
     * @param CreateEntityRequest $request
     * @return JsonResponse
     */
    #[OpenAPI\Operation()]
    #[OpenAPI\RequestBody(factory: CreateEntityRequestBody::class)]
    #[OpenAPI\Response(factory: EntityResponse::class, statusCode: 201)]
    #[OpenAPI\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function __invoke(CreateEntityRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        /** @var Team $team */
        $team = $request->team();

        /** @var Entity $entity */
        $entity = $team->entities()->make(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description', ''),
            ]
        );

        $entity->author()->associate($user)->save();

        return (new EntityResource($entity))
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
