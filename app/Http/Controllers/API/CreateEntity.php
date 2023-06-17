<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEntityRequest;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CreateEntity extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateEntityRequest $request)
    {
        /** @var User $user */
        $user = $request->user();

        /** @var Team $team */
        $team = $request->team();

        /** @var Entity $entity */
        $entity = $team->entities()->make(
            [
                'ulid' => Str::ulid(now()),
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
