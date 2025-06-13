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
        Schema::create('map_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_information_id')->constrained('game_informations')->onDelete('cascade');
            $table->string('map_number')->after('game_information_id'); // Kolom map_number (misalnya '1', '2', '3')
            $table->string(column: 'location_name');
            $table->text(column: 'image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_informations');
    }
};
