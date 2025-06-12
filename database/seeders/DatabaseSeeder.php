<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder yang baru Anda buat
        $this->call(GameInformationSeeder::class);
        // ... panggil seeder lainnya jika ada ...
    }
}
