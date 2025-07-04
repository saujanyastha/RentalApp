<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleType; // Don't forget to import your model

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the vehicle types you want to create
        $vehicleTypes = [
            ['type_name' => 'Scooter'],
            ['type_name' => 'Bike'],
            ['type_name' => 'Car'],
        ];

        foreach ($vehicleTypes as $type) {
            VehicleType::firstOrCreate($type); // Use firstOrCreate to prevent duplicates on re-seeding
        }
    }
}