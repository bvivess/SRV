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
        Schema::create('interesting_place_trek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interesting_place_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('trek_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interesting_place_trek');
    }
};
