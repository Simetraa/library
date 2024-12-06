<?php

namespace Database\Factories;

use App\Http\Controllers\CategoryController;
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
        $categories = app(CategoryController::class)->getCategories();

        $fakeCategories = [];

        for ($i = 0; $i < random_int(0, 5); $i++) {
            $fakeSubject = fake()->randomElement($categories);
            $fakeCategories[] = fake()->randomElement($fakeSubject);
        }

        return [
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'cover_url' => "https://m.media-amazon.com/images/I/81-VVvqF2UL._AC_UF894,1000_QL80_.jpg",
            'subjects' => $fakeCategories,
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(5, 20),
            'quantity' => fake()->numberBetween(0, 10),
            //
        ];
    }
}
