<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorValidationResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('The given data was invalid'),
            Schema::object('errors')
                ->additionalProperties(
                    Schema::array()->items(Schema::string())
                )
                ->example(['field' => ['Something is wrong with the given field!']])
        );

        return Response::create('ErrorValidation')
            ->description('Validation errors')
            ->content(
                MediaType::json()->schema($response),
            );
    }
}
