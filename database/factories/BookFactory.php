<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'cover_url' => "https://m.media-amazon.com/images/I/81-VVvqF2UL._AC_UF894,1000_QL80_.jpg",
            'description' => fake()->paragraph(),
            //
        ];
    }
}
