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
        Schema::create('race_hq_npcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_list_informations_id')->constrained('npc_list_informations')->onDelete('cascade');
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
        Schema::dropIfExists('race_hq_npcs');
    }
};
