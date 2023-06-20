<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\CreateInstanceSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class CreateInstanceRequestBody extends RequestBodyFactory implements Reusable
{
    public function build(): RequestBody
    {
        return RequestBody::create('CreateInstanceRequest')
            ->description('Create an instance of a custom entity')
            ->content(
                MediaType::json()->schema(CreateInstanceSchema::ref()),
            );
    }
}
