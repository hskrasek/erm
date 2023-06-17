<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ulid' => Str::ulid(),
            'team_id' => Team::all()->random(),
            'author_id' => fn (array $attributes) => $attributes['team_id']->users->first(),
            'name' => Str::ucfirst($this->faker->unique()->word),
            'description' => $this->faker->sentence,
        ];
    }
}
