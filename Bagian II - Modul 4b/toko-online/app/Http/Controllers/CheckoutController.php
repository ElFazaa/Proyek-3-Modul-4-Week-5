<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $keranjang = $request->session()->get('keranjang', []);

        if (empty($keranjang)) {
            return back()->with('pesan', 'Keranjang masih kosong.');
        }

        $pesanan = DB::transaction(function () use ($request, $keranjang) {
            $produk = Product::whereIn(
                'id_barang',
                array_keys($keranjang)
            )
                ->orderBy('id_barang')
                ->lockForUpdate()
                ->get();

            if ($produk->count() != count($keranjang)) {
                throw ValidationException::withMessages([
                    'checkout' => 'Ada barang yang sudah tidak tersedia.',
                ]);
            }

            $total = 0;

            foreach ($produk as $item) {
                $jumlah = $keranjang[$item->id_barang];

                if (!is_int($jumlah) || $jumlah < 1) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Jumlah barang tidak valid.',
                    ]);
                }

                if ($jumlah > $item->stok) {
                    throw ValidationException::withMessages([
                        'checkout' => 'Stok ' . $item->nama_barang . ' tidak cukup.',
                    ]);
                }

                $total += $item->harga * $jumlah;
            }

            $pesanan = Order::create([
                'id_order' => 'ORD' . Str::upper(Str::random(12)),
                'id_user' => $request->user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $total,
                'alamat_pengiriman' => $request->user()->alamat,
            ]);

            foreach ($produk as $item) {
                $jumlah = $keranjang[$item->id_barang];

                DB::table('order_details')->insert([
                    'id_order' => $pesanan->id_order,
                    'id_barang' => $item->id_barang,
                    'harga_satuan' => $item->harga,
                    'jumlah_beli' => $jumlah,
                ]);

                $item->decrement('stok', $jumlah);
            }

            return $pesanan;
        });

        $request->session()->forget('keranjang');

        return redirect()->route('keranjang.index')->with(
            'pesan',
            'Checkout berhasil. Nomor pesanan: ' . $pesanan->id_order
        );
    }
}