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
        Schema::create('gown_scores', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_number'); // Assuming candidate_number is a string
            $table->integer('suitability')->nullable(); // Assuming suitability is an integer
            $table->integer('poise_grace_projection')->nullable(); // Assuming poise_grace_projection is an integer
            $table->string('judge_name'); // Assuming judge_name is a string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gown_scores');
    }
};
