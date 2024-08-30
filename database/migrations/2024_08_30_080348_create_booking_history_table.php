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
        Schema::create('booking_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id') ->constrained('bookings') ->onUpdate('cascade') ->onDelete('cascade');
            $table->enum('status', ['booked', 'checked_in', 'checked_out','canceled']);
            $table->timestamp('change_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_history');
    }
};
