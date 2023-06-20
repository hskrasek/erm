<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\InstanceSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class InstanceResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok('InstanceResponse')
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(InstanceSchema::ref())
            );
    }
}
