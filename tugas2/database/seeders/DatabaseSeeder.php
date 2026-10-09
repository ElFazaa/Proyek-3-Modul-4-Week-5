<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Barang::create([
            'nama' => 'Buku Tulis',
            'harga' => 5000,
            'stok' => 20,
        ]);

        Barang::create([
            'nama' => 'Pulpen',
            'harga' => 8000,
            'stok' => 30,
        ]);

        Barang::create([
            'nama' => 'Penggaris',
            'harga' => 5000,
            'stok' => 15,
        ]);

        Barang::create([
            'nama' => 'Pensil 2B',
            'harga' => 2500,
            'stok' => 25,
        ]);

        Barang::create([
            'nama' => 'Penghapus',
            'harga' => 1500,
            'stok' => 20,
        ]);
    }
}