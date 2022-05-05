<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'image' => 'products/ec8e99bb-6229-4030-8218-46a17486a947_5nUMMrmVM9WwN2ESZSyUppuhxhLSug8P1mVXVsfk.jpg',
        ];
    }
}
