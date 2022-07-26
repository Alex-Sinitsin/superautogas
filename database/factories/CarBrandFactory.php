<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarBrand>
 */
class CarBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->randomElement(['Lexus', 'Toyota', 'Ford', 'Opel']),
            'logotype' => fake()->image('storage/car_brands', 300, 300, null, false),
            'is_active' => rand(0, 1)
        ];
    }
}
