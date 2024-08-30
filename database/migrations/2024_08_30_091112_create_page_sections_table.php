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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('section_title', 255);
            $table->text('content')->nullable();
            $table->enum('type', ['text', 'image', 'video', 'carousel']);
            $table->string('media_path', 255)->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('page_id')->references('id')->on('pages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
