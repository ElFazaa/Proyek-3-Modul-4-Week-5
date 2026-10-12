<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            [
                'id_barang' => 'BRG001',
                'nama_barang' => 'Buku Tulis',
                'deskripsi' => 'Buku tulis untuk mencatat pelajaran.',
                'harga' => 5000,
                'stok' => 20,
                'gambar' => 'buku-tulis.jpg',
            ],
            [
                'id_barang' => 'BRG002',
                'nama_barang' => 'Pulpen',
                'deskripsi' => 'Pulpen dengan tinta hitam.',
                'harga' => 8000,
                'stok' => 30,
                'gambar' => 'pulpen.jpg',
            ],
            [
                'id_barang' => 'BRG003',
                'nama_barang' => 'Penggaris',
                'deskripsi' => 'Penggaris sepanjang 30 cm.',
                'harga' => 5000,
                'stok' => 15,
                'gambar' => 'penggaris.jpg',
            ],
            [
                'id_barang' => 'BRG004',
                'nama_barang' => 'Pensil 2B',
                'deskripsi' => 'Pensil untuk menulis dan menggambar.',
                'harga' => 2500,
                'stok' => 25,
                'gambar' => 'pensil.jpg',
            ],
            [
                'id_barang' => 'BRG005',
                'nama_barang' => 'Penghapus',
                'deskripsi' => 'Penghapus untuk tulisan pensil.',
                'harga' => 1500,
                'stok' => 20,
                'gambar' => 'penghapus.jpg',
            ],
            [
                'id_barang' => 'BRG006',
                'nama_barang' => 'Spidol',
                'deskripsi' => 'Spidol untuk papan tulis putih.',
                'harga' => 8000,
                'stok' => 10,
                'gambar' => 'spidol.jpg',
            ],
            [
                'id_barang' => 'BRG007',
                'nama_barang' => 'Stabilo',
                'deskripsi' => 'Penanda untuk menyoroti catatan.',
                'harga' => 7000,
                'stok' => 12,
                'gambar' => 'stabilo.jpg',
            ],
            [
                'id_barang' => 'BRG008',
                'nama_barang' => 'Map Plastik',
                'deskripsi' => 'Map untuk menyimpan dokumen.',
                'harga' => 3500,
                'stok' => 18,
                'gambar' => 'map.jpg',
            ],
            [
                'id_barang' => 'BRG009',
                'nama_barang' => 'Lem',
                'deskripsi' => 'Lem untuk merekatkan kertas.',
                'harga' => 6000,
                'stok' => 14,
                'gambar' => 'lem.jpg',
            ],
            [
                'id_barang' => 'BRG010',
                'nama_barang' => 'Gunting',
                'deskripsi' => 'Gunting untuk kebutuhan alat tulis.',
                'harga' => 10000,
                'stok' => 0,
                'gambar' => 'gunting.jpg',
            ],
        ];

        foreach ($produk as $item) {
            Product::create($item);
        }
    }
}