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

class AddAttributes extends Controller
{

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
