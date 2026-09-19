<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = 'CgmpAdmin!2026';

        User::query()->updateOrCreate(
            ['email' => 'admin@cgmp.local'],
            [
                'name' => 'CGMP Admin',
                'password' => Hash::make($password),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command?->warn("Admin login seeded: admin@cgmp.local / {$password} — change this immediately after first login.");
    }
}
