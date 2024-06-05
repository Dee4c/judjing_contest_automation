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
        Schema::create('swim_suit_scores', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_number');
            $table->integer('composure')->nullable();
            $table->integer('poise_grace_projection')->nullable();
            $table->string('judge_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swim_suit_scores');
    }
};
