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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            // Using polymorphic relationship for flexibility
            $table->string('imageable_type'); // Stores the model class name (e.g., App\Models\User, App\Models\Vehicle)
            $table->unsignedBigInteger('imageable_id'); // Stores the ID of the related model
            $table->index(['imageable_type', 'imageable_id']); // For faster lookups

            $table->string('image_type')->nullable(); // e.g., Profile, Vehicle, Document, Rental Agreement, Payment Proof
            $table->string('path'); // Store the path to the image file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};