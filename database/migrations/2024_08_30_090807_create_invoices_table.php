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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('hotel_id');
            $table->timestamp('issue_date');
            $table->datetime('due_date');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('gst_percentage', 5, 2);
            $table->decimal('gst_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_status', 50);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
