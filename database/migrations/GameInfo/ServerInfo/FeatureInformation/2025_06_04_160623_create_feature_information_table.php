<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureInformationsTable extends Migration
{
    public function up()
    {
        Schema::create('feature_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_information_id')->constrained()->onDelete('cascade');
            $table->string('title');  // judul/penanda fitur
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('feature_information');
    }
}