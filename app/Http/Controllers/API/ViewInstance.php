<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstanceResource;
use App\Models\Instance;
use App\OpenApi\Responses\InstanceResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenAPI;

#[OpenAPI\PathItem]
class ViewInstance extends Controller
{
    /**
     * @param Request $request
     * @param Instance $instance
     * @return InstanceResource
     */
    #[OpenAPI\Operation]
    #[OpenAPI\Response(factory: InstanceResponse::class, statusCode: 200)]
    public function __invoke(Request $request, Instance $instance): InstanceResource
    {
        return new InstanceResource($instance->load('parent'));
    }
}
