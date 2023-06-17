<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entity::truncate();

        User::all()->each(function (User $user) {
            $teams = $user->currentTeam;

            Entity::factory(fake()->numberBetween(1, 15))
                ->for($teams, 'team')
                ->for($user, 'author')
                ->create();
        });
    }
}
