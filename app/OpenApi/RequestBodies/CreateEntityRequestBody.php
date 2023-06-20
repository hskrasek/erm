<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\CreateEntitySchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateEntityRequestBody extends RequestBodyFactory implements Reusable
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateEntityRequest')
            ->description('Create a new entity to use within the application')
            ->content(
                MediaType::json()->schema(CreateEntitySchema::ref())
            );
    }
}
