<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'father_name' => fake()->regexify('[A-Za-z0-9]{100}'),
            'date_of_birth' => fake()->date(),
            'gender' => fake()->randomElement(["male","female","other"]),
            'cnic' => fake()->regexify('[A-Za-z0-9]{20}'),
            'bar_license_number' => fake()->regexify('[A-Za-z0-9]{50}'),
            'cnic_image' => fake()->sha256(),
            'fingerprint1' => fake()->sha256(),
            'fingerprint2' => fake()->sha256(),
            'fingerprint3' => fake()->sha256(),
            'fingerprint4' => fake()->sha256(),
            'face_data' => fake()->sha256(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'password' => Hash::make('password'),
            // 'role_id' => 1,
            'is_verified_nadra' => fake()->boolean(),
            'is_verified_hcb' => fake()->boolean(),
            'status' => fake()->randomElement(["inactive","active","suspended"]),
            'dues_paid' => fake()->boolean(),
            'email_verified_at' => fake()->dateTime(),
            'remember_token' => Str::random(10),
        ];
    }
}
