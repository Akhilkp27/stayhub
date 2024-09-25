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
        Schema::create('customer_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Reference to the customer
            $table->string('action'); // E.g., 'login', 'booking', 'cancellation'
            $table->text('description')->nullable(); // Additional details about the action
            $table->ipAddress('ip_address')->nullable(); // Store IP address
            $table->string('user_agent')->nullable(); // Store user-agent info (browser, device)
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_activity_logs');
    }
};
