<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // Demo User Account
        User::updateOrCreate(
            ['email' => 'sapik@gmail.com'],
            [
                'name' => 'Muhammad Syafiq',
                'password' => Hash::make('password'),
                'role' => 'user'
            ]
        );
    }
}
