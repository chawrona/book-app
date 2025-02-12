<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'release_year' => fake()->numberBetween(1900, 2024),
            'description' => fake()->paragraph(),
        ];
    }
}
