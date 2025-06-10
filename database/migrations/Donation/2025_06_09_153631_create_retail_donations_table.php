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
        Schema::create('retail_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'donation_id')->constrained()->onDelete('cascade');
            $table->string(column: 'title');
            $table->integer('pricing')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_donations');
    }
};
