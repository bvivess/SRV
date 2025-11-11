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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onUpdate("restrict")->onDelete("restrict");
            $table->foreignId("trek_id")->constrained()->onUpdate("restrict")->onDelete("restrict");
            $table->date("day");
            $table->time("time");
            $table->integer('totalScore')->default(0);
            $table->integer('countScore')->default(0);
            $table->date("appDateIni");
            $table->date("appDateEnd");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
