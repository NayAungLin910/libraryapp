<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\User;
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
            'user_id' => User::factory(),
            'author_id' => Author::factory(),
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'image' => '/default_images/book_sample_image.jpg',
            'file' => '/default_images/sample_book.pdf',
            'download_count' => random_int(3, 12),
        ];
    }
}
