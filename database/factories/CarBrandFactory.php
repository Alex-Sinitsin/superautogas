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
            'name' => fake()->randomElements(['Lexus', 'Toyota', 'Ford', 'Opel', 'Suzuki', 'UAZ', 'Lada'], 1, false)[0],
            'logotype' => fake()->imageUrl(300, 300),
            'is_active' => 1
        ];
    }
}
