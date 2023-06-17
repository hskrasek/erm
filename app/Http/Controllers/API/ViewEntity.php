<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use Illuminate\Http\Request;

class ViewEntity extends Controller
{
    public function __invoke(Request $request, Entity $entity)
    {
        return new EntityResource($entity->load('attributes', 'author'));
    }
}
