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
        Schema::create('event_referee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('referee_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();

            $table->unique(['event_id', 'referee_id']);  // Assegura que només hi hagi un registre per a cada match_id i referee_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_referee');
    }
};
