<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin123@example.com'],
            [
                'username' => 'Admin',
                'email' => 'admin123@example.com',
                'password' => Hash::make('admin123'),
                'PIN' => '123456',
                'is_admin' => true,
            ]
        );

        if ($admin->tokens()->count() === 0) {
            $token = $admin->createToken('admin-token')->plainTextToken;
            echo "Admin Token: $token\n";
        }
    }
}
