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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('hour');
            $table->integer('goals_home');
            $table->integer('goals_away');
            $table->foreignId('home_team_id')->constrained('teams','id')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('away_team_id')->constrained('teams','id')->onUpdate('restrict')->onDelete('restrict');    
            $table->foreignId('matchday_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();

            $table->unique(['matchday_id', 'home_team_id', 'away_team_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
