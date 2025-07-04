<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Foreign Key to Users table
            $table->string('name')->nullable(); // General name for the vehicle
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->integer('make_year')->nullable();
            $table->string('lot_no')->nullable();
            $table->string('engine_no')->unique();
            $table->string('vehicle_no')->unique(); // License plate number or unique ID
            $table->foreignId('type_id')->constrained('vehicle_types')->onDelete('restrict'); // Foreign Key to VehicleTypes table
            $table->string('chassis_no')->unique();
            $table->string('status')->default('available'); // e.g., available, rented, maintenance
            $table->decimal('purchased_price', 10, 2)->nullable();
            $table->date('purchased_date')->nullable();
            $table->text('note')->nullable();
            $table->date('tax_renewal_date')->nullable();
            $table->date('insurance_renewal_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};