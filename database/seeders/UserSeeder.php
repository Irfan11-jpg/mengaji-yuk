<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Ustadz Ahmad',
            'email'    => 'guru@mengajiyuk.com',
            'password' => Hash::make('password'),
            'role'     => 'guru',
        ]);

        User::create([
            'name'     => 'Santri Budi',
            'email'    => 'budi@mengajiyuk.com',
            'password' => Hash::make('password'),
            'role'     => 'santri',
        ]);
    }
}