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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('renter_id')->constrained('users')->onDelete('cascade');
            $table->date('rental_start_date');
            $table->date('rental_end_date')->nullable(); // Can be null for ongoing rentals or if not estimated
            $table->date('payment_start_date');
            $table->decimal('daily_amount', 10, 2);
            $table->boolean('advance')->default(false); // Indicates if an advance payment was made
            $table->decimal('advance_amount', 10, 2)->nullable();
            $table->string('status')->default('pending'); // e.g., pending, active, completed, cancelled
            $table->date('estimated_rent_end_date')->nullable(); // Optional, for initial planning
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};