<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\PerformedBy;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintLogFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'complaint_id' => Complaint::factory(),
            'action' => fake()->text(),
            'performed_by' => PerformedBy::factory(),
            'timestamp' => fake()->dateTime(),
            'performed_by_id' => User::factory(),
        ];
    }
}
