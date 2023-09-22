<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Import the Str class

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
    public function definition(): array
    {
        $name = $this->faker->word;
        $description = $this->faker->sentence;
        $price = $this->faker->randomFloat(2, 10, 1000);
        $slug = Str::slug($name); // Generating a slug based on the product name

        return [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'slug' => $slug, // Include the "slug" attribute
        ];
    }
}
