<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'hcba_balance' => fake()->randomFloat(2, 0, 99999999.99),
        ];
    }
}
