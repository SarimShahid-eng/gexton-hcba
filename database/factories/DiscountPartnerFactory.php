<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountPartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'discount_percentage' => fake()->randomFloat(2, 0, 999.99),
            'mou_details' => fake()->text(),
        ];
    }
}
