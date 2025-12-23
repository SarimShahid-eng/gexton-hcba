<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WelfareClaimFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => fake()->randomElement(["medical","death"]),
            'amount' => fake()->randomFloat(2, 0, 99999999.99),
            'description' => fake()->text(),
            'attachments' => fake()->text(),
            'status' => fake()->randomElement(["received","approved","ready","rejected"]),
        ];
    }
}
