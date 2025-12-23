<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OtpFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'identifier' => fake()->word(),
            'otp' => fake()->word(),
            'type' => fake()->randomElement(["register","login","password_reset"]),
            'expires_at' => fake()->dateTime(),
            'used_at' => fake()->dateTime(),
        ];
    }
}
