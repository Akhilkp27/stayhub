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
        Schema::table('rooms', function (Blueprint $table) {
            // Add a nullable foreign key column for current_status_id
            $table->unsignedBigInteger('current_status_id')->nullable()->after('availability');
        
            // Set up the foreign key constraint to reference the room_statuses table
            $table->foreign('current_status_id')->references('id')->on('room_statuses')->onUpdate('cascade')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign(['current_status_id']);
            $table->dropColumn('current_status_id');
        });
    }
};
