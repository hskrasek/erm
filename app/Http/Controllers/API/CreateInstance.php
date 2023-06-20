<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInstanceRequest;
use App\Http\Resources\InstanceResource;
use App\Models\Attribute;
use App\Models\Instance;
use App\OpenApi\RequestBodies\CreateInstanceRequestBody;
use App\OpenApi\Responses\ErrorValidationResponse;
use App\OpenApi\Responses\InstanceResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Vyuldashev\LaravelOpenApi\Attributes as OpenAPI;

#[OpenAPI\PathItem]
class CreateInstance extends Controller
{
    /**
     * @param CreateInstanceRequest $request
     * @return JsonResponse
     */
    #[OpenAPI\Operation()]
    #[OpenAPI\RequestBody(factory: CreateInstanceRequestBody::class)]
    #[OpenAPI\Response(factory: InstanceResponse::class, statusCode: 201)]
    #[OpenAPI\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function __invoke(CreateInstanceRequest $request): JsonResponse
    {
        $entity = $request->entity();

        /** @var Collection<array{attribute: Attribute, value: mixed}> $attributes */
        $attributes = Collection::make($request->input('attributes'))
            ->map(fn (array $attribute) => ['attribute' => Attribute::whereUlid($attribute['attribute_id'])->first(), 'value' => $attribute['value']]);

        /** @var Instance $instance */
        $instance = $entity->instances()
            ->make(
                [
                    'attributes' => new \ArrayObject($attributes->mapWithKeys(fn (array $attribute) => [$attribute['attribute']->name => $attribute['value']])
                        ->all()),
                ]
            );

        $instance->team()->associate($request->team())->save();

        return (new InstanceResource($instance))
            ->toResponse($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
