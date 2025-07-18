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
        Schema::create('daily_quest_after_war', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'category');
            $table->string('image')->nullable();
            $table->string('daily_quest');
            $table->string(column: 'map');
            $table->string('quest');
            $table->string('reward');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_quest_after_war');
    }
};
