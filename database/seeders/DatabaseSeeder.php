<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); // You can keep or remove this, it seeds default users

        $this->call([
            UserTypeSeeder::class, // Call your UserTypeSeeder
            VehicleTypeSeeder::class, // Call your VehicleTypeSeeder
            // Add other seeders here as you create them
            // E.g., UserSeeder::class, if you create a custom one later
            // VehicleSeeder::class,
        ]);

        // Example for creating a specific user and assigning a user type
        // if you don't use the default User::factory above
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password'), // Hash the password
        //     'type_id' => UserType::where('type_name', 'Admin')->first()->id, // Assign Admin type
        //     'personal_contactphone_number' => '9800000000'
        // ]);
    }
}