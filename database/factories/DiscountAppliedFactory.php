<?php

namespace Database\Factories;

use App\Models\DiscountPartner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountAppliedFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'discount_partner_id' => DiscountPartner::factory(),
            'amount_saved' => fake()->randomFloat(2, 0, 99999999.99),
            'applied_at' => fake()->dateTime(),
        ];
    }
}
