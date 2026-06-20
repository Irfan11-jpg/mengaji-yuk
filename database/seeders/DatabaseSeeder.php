<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Guru
        User::create([
            'name' => 'Bapak Guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'), // Passwordnya: password123
            'role' => 'guru',
        ]);

        // Membuat akun Santri
        User::create([
            'name' => 'Ahmad Santri',
            'email' => 'santri@gmail.com',
            'password' => Hash::make('password'), // Passwordnya: password123
            'role' => 'santri',
        ]);
    }
}