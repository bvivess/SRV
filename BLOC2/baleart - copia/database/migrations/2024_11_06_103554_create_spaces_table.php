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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('regNumber', 10)->unique();
            $table->text('observation_CA');
            $table->text('observation_ES');
            $table->text('observation_EN');
            $table->string('phone');
            $table->string('email'); 
            $table->string('website');
            $table->enum('accessType', ['y', 'n', 'p'])->default('n');
            $table->integer('totalScore')->default(0);
            $table->integer('countScore')->default(0);
            $table->foreignId('space_type_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('address_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
