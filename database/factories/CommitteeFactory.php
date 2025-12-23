<?php

namespace Database\Factories;

use App\Models\Chairman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommitteeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'chairman_id' => Chairman::factory(),
            'chairman_id_id' => User::factory(),
        ];
    }
}
