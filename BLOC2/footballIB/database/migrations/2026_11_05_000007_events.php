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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('hour');
            $table->integer('goals_home');
            $table->integer('goals_away');
            $table->foreignId('team_id_home')->constrained('teams','id')->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('team_id_away')->constrained('teams','id')->onUpdate('restrict')->onDelete('restrict');    
            $table->foreignId('matchday_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();

            $table->unique(['matchday_id', 'team_id_home', 'team_id_away']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
