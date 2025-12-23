<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinancialTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(["expense","funding","payment","dues"]),
            'amount' => fake()->randomFloat(2, 0, 99999999.99),
            'user_id' => User::factory(),
            'description' => fake()->text(),
            'transaction_date' => fake()->date(),
        ];
    }
}
