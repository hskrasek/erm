<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstanceResource;
use App\Models\Instance;
use Illuminate\Http\Request;

class ViewInstance extends Controller
{
    public function __invoke(Request $request, Instance $instance): InstanceResource
    {
        return new InstanceResource($instance);
    }
}
