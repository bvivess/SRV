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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->integer('shirt_number');
            $table->foreignId('person_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('team_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();

            $table->unique(['team_id', 'shirt_number']);  // Assegura que només hi hagi un dorsal per equip
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
