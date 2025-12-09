<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receptionist>
 */
class ReceptionistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'user_id' => User::factory(), // Automatically create a related user
            'date_of_birth' => $this->faker->date('Y-m-d', '-16 years'), // At least 16 years old
            'shift' => $this->faker->randomElement(['day', 'night', 'full time']),
        ];
    }
}
