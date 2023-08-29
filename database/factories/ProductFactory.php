<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $model = Product::class;

        // Define categories
        $categories = ['Anti-Hero', 'Hero', 'Monster', 'Landscape'];

        $category = fake()->randomElement($categories);

        return [
            'title' => fake()->text(30),
            'image' => fake()->imageUrl(),
            'description' => fake()->realText(2000),
            'description_2' => fake()->realText(2000),
            'category' => $category,
            'price' => fake()->randomFloat(2, 20, 5000),
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
