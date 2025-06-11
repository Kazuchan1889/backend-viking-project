<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('server_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_info_id')->constrained('game_infos')->onDelete('cascade');
            $table->string('title');
            // field lain sesuai kebutuhan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('server_information');
    }
};


