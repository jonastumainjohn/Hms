<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'user_id' => User::factory(), // Generate a related User (ensure UserFactory exists)
            'specialization' => $this->faker->randomElement(['Cardiologist', 'Neurologist', 'Pediatrician', 'General Surgeon', 'Orthopedic']),
            'availability' => $this->faker->sentence(4), // Example: "Monday to Friday, 9 AM to 5 PM"
        ];
    }
}
