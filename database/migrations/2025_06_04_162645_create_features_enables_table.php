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
        Schema::create('features_enables', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'general_information_id')->constrained('general_informations')->onDelete('cascade');
            $table->string('title');
            $table->text('abilities')->nullable(); // diperbaiki di sini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features_enables');
    }
};
