<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('showtime_id')->constrained('showtimes', 'showtime_id')->onDelete('cascade');
            $table->string('seat_number', 10);
            $table->timestamp('booking_date')->useCurrent();
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            $table->timestamps();

            $table->unique(['showtime_id', 'seat_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
