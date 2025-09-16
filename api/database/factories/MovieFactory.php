<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tmdb_id' => fake()->unique()->randomNumber(6),
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'release_date'=> fake()->date(),
            'duration' => fake()->numberBetween(90, 180),
            'cover' => fake()->imageUrl(640, 960, 'movies', true),
            'created_by' => User::factory(),
        ];
    }
}
