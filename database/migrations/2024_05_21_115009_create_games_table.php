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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_one_id')->constrained('users');
            $table->foreignId('player_two_id')->constrained('users')->nullable();
            $table->foreignId('winner_id')->constrained('users')->nullable();
            $table->string('word')->nullable();
            $table->enum('status', ['pending', 'active', 'completed', 'draw'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
