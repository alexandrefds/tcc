<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'for_sale' => $this->faker->boolean(80),
            'for_rent' => $this->faker->boolean(20),
            'sale_price' => $this->faker->randomFloat(2, 100000, 5000000),
            'rent_price' => $this->faker->randomFloat(2, 500, 10000),
            'is_active' => true,
            'created_by' => 1,
        ];
    }
}
