<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun admin default
        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'email' => 'admin@e.com',
            'password' => bcrypt('123456'), // password default
            'role' => 'admin',
        ]);
    }
}
