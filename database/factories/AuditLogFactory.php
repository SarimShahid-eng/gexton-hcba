<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'action' => fake()->regexify('[A-Za-z0-9]{100}'),
            'user_id' => User::factory(),
            'details' => fake()->text(),
            'timestamp' => fake()->dateTime(),
        ];
    }
}
