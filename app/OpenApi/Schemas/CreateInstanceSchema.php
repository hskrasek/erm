<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class CreateInstanceSchema extends SchemaFactory implements Reusable
{
    /**
     * @return AllOf|OneOf|AnyOf|Not|Schema
     */
    public function build(): SchemaContract
    {
        return Schema::object('CreateInstance')
            ->properties(
                Schema::string('entity_id')
                    ->description('The identifier of the Entity you are creating an instance of'),
                Schema::array('attributes')
                    ->description('The list of attributes with values for the new entity instance')
                    ->items(
                        Schema::object()
                            ->properties(
                                Schema::string('attribute_id'),
                                Schema::string('value'),
                            ),
                    ),
            );
    }
}
