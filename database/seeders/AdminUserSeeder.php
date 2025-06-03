<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin123@example.com'],
            [
                'username' => 'Admin',
                'email' => 'admin123@example.com',
                'password' => Hash::make('admin123'),
                'PIN' => '123456',
                'is_admin' => true,
            ]
        );
    }
}
