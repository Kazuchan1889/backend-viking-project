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
        Schema::create('volcanic_cauldron_npcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_information_id')->constrained('game_infos')->onDelete('cascade');
            $table->string('npc'); // Nama NPC
            $table->string('buy_with'); // Bisa "Gold", "Points", dsb
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volcanic_cauldron_npcs');
    }
};
