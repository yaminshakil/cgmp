<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Set ADMIN_EMAIL / ADMIN_PASSWORD in .env to choose the first login; otherwise a random
        // password is generated. An existing admin is never touched, so re-seeding can't reset it.
        $email = env('ADMIN_EMAIL', 'admin@cgmp.local');

        if (User::query()->where('email', $email)->exists()) {
            return;
        }

        $password = env('ADMIN_PASSWORD') ?: Str::password(16, symbols: false);

        User::query()->create([
            'name' => 'CGMP Admin',
            'email' => $email,
            'password' => $password,
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $this->command?->warn("Admin login created: {$email} / {$password} - change this after first login.");
    }
}
