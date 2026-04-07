<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id('showtime_id');
            $table->foreignId('movie_id')->constrained('movies', 'movie_id')->onDelete('cascade');
            $table->foreignId('theater_id')->constrained('theaters', 'theater_id')->onDelete('cascade');
            $table->dateTime('start_time');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
