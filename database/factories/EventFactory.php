<?php

namespace Database\Factories;

use App\Models\Booker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'event_date' => fake()->date(),
            'status' => fake()->randomElement(["available","booked"]),
            'booker_id' => Booker::factory(),
            'payment_status' => fake()->randomElement(["pending","paid"]),
            'booker_id_id' => User::factory(),
        ];
    }
}
