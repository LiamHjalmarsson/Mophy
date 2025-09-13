<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rank>
 */
class RankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(["Beginner", "Pro", "Legend", "Master"]),
            'level' => fake()->numberBetween(1, 100),
            'icon' => fake()->imageUrl(50, 50, 'abstract'),
            'description' => fake()->sentence()
        ];
    }
}
