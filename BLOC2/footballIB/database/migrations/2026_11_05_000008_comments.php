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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('match_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();

            $table->unique(['match_id', 'user_id','updated_at']);  // Assegura que només hi hagi un comentari per a cada match_id i user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
