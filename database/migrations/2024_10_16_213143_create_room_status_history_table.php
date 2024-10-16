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
        Schema::create('room_status_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('updated_by_admin')->nullable(); // Nullable for staff updates
            $table->unsignedBigInteger('updated_by_staff')->nullable(); // Nullable for admin updates
            $table->timestamps();

             // Foreign keys
             $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
             $table->foreign('status_id')->references('id')->on('room_statuses')->onDelete('cascade');
             $table->foreign('updated_by_admin')->references('id')->on('admins')->onDelete('set null');
             $table->foreign('updated_by_staff')->references('id')->on('staffs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_status_history');
    }
};
