<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\EntitySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class EntityResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('EntityResponse')
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(EntitySchema::ref())
            );
    }
}
