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
        Schema::table('users', function (Blueprint $table) {
            // Add type_id as a foreign key after the 'id' column
            // This assumes 'user_types' table will be created before this migration runs due to timestamp order
            $table->foreignId('type_id')->nullable()->after('id')->constrained('user_types')->onDelete('set null');

            // Add other new columns after 'password' for logical grouping
            $table->string('temporary_address')->nullable()->after('password');
            $table->string('permanent_address')->nullable()->after('temporary_address');
            $table->string('personal_contactphone_number')->nullable()->after('permanent_address');
            $table->string('business_contactphone_number')->nullable()->after('personal_contactphone_number');
            $table->string('altextra_phone_number')->nullable()->after('business_contactphone_number');
            $table->string('google_map_location')->nullable()->after('altextra_phone_number');
            $table->string('facebook_link')->nullable()->after('google_map_location');
            $table->string('tiktok_link')->nullable()->after('facebook_link');
            $table->string('instagram_link')->nullable()->after('tiktok_link');
            $table->text('note')->nullable()->after('instagram_link');
            $table->string('photo')->nullable()->after('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['type_id']);
            // Then drop the columns
            $table->dropColumn([
                'type_id',
                'temporary_address',
                'permanent_address',
                'personal_contactphone_number',
                'business_contactphone_number',
                'altextra_phone_number',
                'google_map_location',
                'facebook_link',
                'tiktok_link',
                'instagram_link',
                'note',
                'photo',
            ]);
        });
    }
};