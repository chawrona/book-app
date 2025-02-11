<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
use App\Models\Review;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'book_id' => \App\Models\Book::factory(),
            'review' => $this->faker->sentence(),
            'rate' => $this->faker->numberBetween(1, 5),
        ];
    }
}
