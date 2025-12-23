<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberBalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'balance' => fake()->randomFloat(2, 0, 99999999.99),
            'last_updated' => fake()->dateTime(),
        ];
    }
}
