<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'id_user' => 'USR001',
            'nama_lengkap' => 'Fazapanicus',
            'email' => 'faza@example.com',
            'username' => 'faza',
            'password' => 'faza12345',
            'no_hp' => '081234567890',
            'alamat' => 'Jalan Jatayu 3, Bandung',
        ]);

        User::create([
            'id_user' => 'USR002',
            'nama_lengkap' => 'Nindy Deanira',
            'email' => 'nindy@example.com',
            'username' => 'nindy',
            'password' => 'nindy12345',
            'no_hp' => '081234567891',
            'alamat' => 'Jalan Mawar No. 5, Bandung',
        ]);
        $this->call(ProductSeeder::class);
    }
}