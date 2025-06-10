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
        Schema::create('pendant_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_information_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->string('name_item');
            $table->string('type');
            $table->string('trade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendant_information');
    }
};
