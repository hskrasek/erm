<?php

namespace Database\Seeders;

use App\Enum\Cardinality;
use App\Models\Entity;
use App\Models\Instance;
use App\Models\Relationship;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AddressBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = Team::whereName('Digital Rolodex Inc.')->first();

        if ($team !== null) {
            $team->users()->delete();
            $team->owner()->delete();
            $team->entities->each(fn(Entity $entity) => $entity->attributes()->delete());
            $team->entities->each(fn(Entity $entity) => $entity->relationships()->delete());
            $team->entities->each(fn(Entity $entity) => $entity->instances()->delete());
            $team->entities()->delete();

            $team->delete();
        }

        /** @var Team $team */
        $team = Team::factory()
            ->state(fn(array $attributes) => ['name' => 'Digital Rolodex Inc.'])
            ->hasAttached(
                factory: User::factory()->count(3),
                pivot: fn() => ['role' => Arr::random(['admin', 'editor'])]
            )->createOne();

        // Create Address Book Entity
        /**
         * @var $addressBookEntity Entity
         * @var $contactEntity Entity
         */
        [$addressBookEntity, $contactEntity] = $team->entities()
            ->makeMany(
                [
                    [
                        'name' => 'Address Book',
                        'description' => 'A list of contacts.'
                    ],
                    [
                        'name' => 'Contact',
                        'description' => 'A person or company you have information on.'
                    ]
                ]
            )->all();
        $addressBookEntity->author()->associate($team->users->random())->save();
        $contactEntity->author()->associate($team->users->random())->save();

        // Create Address Book Attributes
        $addressBookEntity
            ->attributes()
            ->create([
                'name' => 'name',
            ]);

        // Create Contact Attributes
        $contactEntity
            ->attributes()
            ->createMany(
                [
                    [
                        'name' => 'first_name',
                    ],
                    [
                        'name' => 'last_name',
                    ]
                ]
            );

        // Create Relationships Between Contacts
        $addressBookEntity
            ->relationships()
            ->make([
                'name' => 'contacts',
                'minimum' => Cardinality::ZERO,
                'maximum' => Cardinality::MANY,
            ])->childEntity()->associate($contactEntity)->save();

        $contactEntity
            ->relationships()
            ->makeMany([
                [
                    'name' => 'father',
                    'minimum' => Cardinality::ZERO,
                    'maximum' => Cardinality::MANY,
                ],
                [
                    'name' => 'mother',
                    'minimum' => Cardinality::ZERO,
                    'maximum' => Cardinality::MANY,
                ]
            ])->each(fn(Relationship $relationship) => $relationship->childEntity()->associate($contactEntity)->save());

        /** @var Instance $addressBook */
        $addressBook = $addressBookEntity->instances()
            ->make([
                'attributes' => [
                    'name' => 'Contacts'
                ]
            ]);

        $addressBook
            ->team()
            ->associate($team)
            ->save();

        /** @var Instance $contactOne */
        $contactOne = $contactEntity->instances()
            ->make([
                'attributes' => [
                    'first_name' => 'John',
                    'last_name' => 'Appleseed',
                ]
            ]);

        $contactOne
            ->team()
            ->associate($team)
            ->save();

        /** @var Instance $contactTwo */
        $contactTwo = $contactEntity->instances()
            ->make([
                'attributes' => [
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                ]
            ]);

        $contactTwo
            ->team()
            ->associate($team)
            ->save();

        $addressBook
            ->children()
            ->saveMany([$contactOne, $contactTwo], [['relationship_id' => Relationship::whereName('contacts')->first()->id], ['relationship_id' => Relationship::whereName('contacts')->first()->id]]);

        $contactOne
            ->parent()
            ->attach($contactTwo, ['relationship_id' => Relationship::whereName('mother')->first()->id]);
    }
}
