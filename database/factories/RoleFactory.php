<?php

namespace Database\Factories;

use App\Models\Committee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'committee_id' => Committee::factory(),
            'role_name' => fake()->regexify('[A-Za-z0-9]{50}'),
            'privileges' => fake()->text(),
        ];
    }
}
