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
        Schema::table('map_information', function (Blueprint $table) {
            // Tambahkan kolom 'map_number' sebagai string atau integer
            // Sesuaikan jenis data jika perlu, misalnya integer jika hanya 1,2,3,4
            $table->string('map_number')->after('game_information_id'); // atau setelah kolom lain yang sesuai
            // Jika Anda punya kolom 'category' di sini, pertimbangkan apakah 'map_number' akan menggantikannya atau melengkapinya.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('map_information', function (Blueprint $table) {
            $table->dropColumn('map_number');
        });
    }
};