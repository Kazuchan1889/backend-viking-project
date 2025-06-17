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
        Schema::create('item_package_bonus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_bonus_id')->constrained('package_bonuses')->onDelete('cascade');
            $table->foreignId('items_id')->constrained('items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_package_bonus');
    }
};
