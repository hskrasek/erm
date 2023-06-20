<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\CreateAttributeSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateAttributeRequestBody extends RequestBodyFactory implements Reusable
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateAttributeRequest')
            ->description('Create a new attribute for an entity')
            ->content(
                MediaType::json()->schema(CreateAttributeSchema::ref())
            );
    }
}
