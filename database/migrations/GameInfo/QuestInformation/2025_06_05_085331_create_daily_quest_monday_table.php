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
        Schema::create('daily_quest_mondays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quest_information_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('tutorial');
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
        Schema::dropIfExists('daily_quest_mondays');
    }
};
