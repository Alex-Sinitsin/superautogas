<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nickname' => fake()->name(),
            'car_model' => fake()->words(2, true),
            'rating' => rand(1, 5),
            'text' => fake()->paragraph(3),
            'is_published' => rand(0, 1)
        ];
    }
}
