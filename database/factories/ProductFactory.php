<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'category_id' => Category::factory()->create()->id,
            'name' => $this->faker->name(),
            'price' => 2000.86,
            'stock' => 20,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text(100),
        ];
    }

    public function unverified(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
