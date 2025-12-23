<?php

namespace Database\Factories;

use App\Models\Candidate;
use App\Models\Election;
use App\Models\User;
use App\Models\Voter;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'election_id' => Election::factory(),
            'voter_id' => Voter::factory(),
            'candidate_id' => Candidate::factory(),
            'voted_at' => fake()->dateTime(),
            'voter_id_id' => User::factory(),
        ];
    }
}
