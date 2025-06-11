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
        Schema::create('package_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'donation_id')->constrained('donations')->onDelete('cascade');
            $table->string(column: 'title');
            $table->text('description')->nullable();
            $table->integer('pricing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_donations');
    }
};
