<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'faza',
            'password' => 'faza12345',
            'nama_lengkap' => 'Fazapanicus',
        ]);

        User::create([
            'username' => 'nindy',
            'password' => 'nindy12345',
            'nama_lengkap' => 'Nindy Deanira',
        ]);
    }
}