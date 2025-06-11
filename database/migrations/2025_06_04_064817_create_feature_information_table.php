<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feature_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_information_id')->constrained('server_information')->onDelete('cascade');
            $table->string('title');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feature_information');
    }
};
