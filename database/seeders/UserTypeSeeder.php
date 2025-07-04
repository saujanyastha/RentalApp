<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType; // Don't forget to import your model

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the user types you want to create
        $userTypes = [
            ['type_name' => 'Renter'],
            ['type_name' => 'Owner'],
            ['type_name' => 'Admin'],
            ['type_name' => 'Witness'],
        ];

        foreach ($userTypes as $type) {
            UserType::firstOrCreate($type); // Use firstOrCreate to prevent duplicates on re-seeding
        }
    }
}