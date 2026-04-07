<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theaters', function (Blueprint $table) {
            $table->id('theater_id');
            $table->string('name', 50);
            $table->integer('capacity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theaters');
    }
};
