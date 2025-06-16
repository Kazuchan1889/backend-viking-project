<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('droplist', function (Blueprint $table) {
            $table->id();
            $table->string('droplist'); // Nama NPC
            $table->string('buy_with'); // Gold, Points, dll
            $table->foreignId('map_information_id')->constrained('map_informations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('droplist');
    }
};
