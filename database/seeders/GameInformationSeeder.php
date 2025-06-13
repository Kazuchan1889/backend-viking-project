<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class GameInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('game_informations')->insert([ // Perhatikan 'game_informations'
            'id' => 1, // Pastikan ada ID 1
            'name' => 'PendantInformation', // Sesuaikan dengan kolom 'name' Anda
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambahkan data lain jika diperlukan
        // DB::table('game_informations')->insert([
        //     'id' => 2,
        //     'name' => 'Another Game Setting',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}