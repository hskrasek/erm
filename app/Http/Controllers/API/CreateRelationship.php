<?php

namespace App\Http\Controllers\API;

use App\Enum\Cardinality;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRelationshipRequest;
use App\Http\Resources\RelationshipResource;
use App\Models\Relationship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateRelationship extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreateRelationshipRequest $request)
    {
        $parentEntity = $request->parentEntity();

        $childEntity = $request->childEntity();

        /** @var Relationship $relationship */
        $relationship = $parentEntity->relationships()
            ->make([
                'name' => $request->input('name'),
                'minimum' => Cardinality::from($request->input('minimum')),
                'maximum' => Cardinality::from($request->input('maximum')),
            ]);

        $relationship->childEntity()
            ->associate($childEntity);

        $relationship->save();

        return (new RelationshipResource($relationship))
            ->response($request)
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
