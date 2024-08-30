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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 50);
            $table->foreignId('room_type_id')->constrained('room_types')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('price_per_night', 10, 2);
            $table->boolean('availability');
            $table->integer('max_adults');
            $table->integer('max_children');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
