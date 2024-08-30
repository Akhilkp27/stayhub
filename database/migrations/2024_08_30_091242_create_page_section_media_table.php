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
        Schema::create('page_section_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_section_id');
            $table->string('media_path', 255);
            $table->string('media_type', 255);
            $table->integer('order')->default(0);
            $table->timestamps();

             // Foreign key constraint
             $table->foreign('page_section_id')->references('id')->on('page_sections')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_section_media');
    }
};
