<?php

namespace Database\Factories;

use App\Models\PostedBy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(3, true),
            'posted_by' => PostedBy::factory(),
            'posted_at' => fake()->dateTime(),
            'posted_by_id' => User::factory(),
        ];
    }
}
