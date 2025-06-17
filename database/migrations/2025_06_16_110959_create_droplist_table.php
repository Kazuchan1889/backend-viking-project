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
            $table->string('monster'); 
            $table->foreignId('items_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('map_information_id')->constrained('map_informations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('droplist');
    }
};
