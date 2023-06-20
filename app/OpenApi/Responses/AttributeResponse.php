<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\AttributeSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class AttributeResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        return Response::ok('AttributeResponse')
            ->description('Successful response')
            ->content(
                MediaType::json()->schema(AttributeSchema::ref()),
            );
    }
}
