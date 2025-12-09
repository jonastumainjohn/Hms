<?php

namespace Database\Seeders;

use App\Models\Receptionist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create 25 users with type 'receptionist'
         $users = User::factory()->count(25)->create([
            'type' => 'receptionist',
            
        ]);

        // Create 25 receptionists associated with the users
        $users->each(function ($user) {
            Receptionist::factory()->create([
                'user_id' => $user->id,
                
            ]);
        });
    }
}
