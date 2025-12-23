<?php

namespace Database\Factories;

use App\Models\ComplaintCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'complaint_category_id' => ComplaintCategory::factory(),
            'description' => fake()->text(),
            'attachments' => fake()->text(),
            'status' => fake()->randomElement(["received","forwarded","resolved","escalated"]),
            'satisfaction' => fake()->randomElement(["yes","no"]),
        ];
    }
}
