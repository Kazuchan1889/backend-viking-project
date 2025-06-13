<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('features_disables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_information_id')->constrained('game_informations')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable(); // diperbaiki di sini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('features_disables');
    }
};
