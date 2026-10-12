<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $produk = Product::all();
        $keranjang = $request->session()->get('keranjang', []);

        $jumlahItem = array_sum($keranjang);

        return view('barang', compact('produk', 'jumlahItem'));
    }

    public function keranjang(Request $request)
    {
        $keranjang = $request->session()->get('keranjang', []);

        $produk = Product::whereIn(
            'id_barang',
            array_keys($keranjang)
        )->get();

        $total = 0;

        foreach ($produk as $item) {
            $total += $item->harga * $keranjang[$item->id_barang];
        }

        return view('keranjang', compact('produk', 'keranjang', 'total'));
    }

    public function tambah(Request $request, $id)
    {
        $barang = Product::findOrFail($id);
        $keranjang = $request->session()->get('keranjang', []);

        $jumlah = $keranjang[$id] ?? 0;

        if ($jumlah >= $barang->stok) {
            return back()->with(
                'pesan',
                'Barang habis atau jumlah sudah mencapai stok.'
            );
        }

        $keranjang[$id] = $jumlah + 1;

        $request->session()->put('keranjang', $keranjang);

        return back()->with('pesan', 'Barang ditambahkan ke keranjang.');
    }

    public function kurang(Request $request, $id)
    {
        $keranjang = $request->session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]--;

            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
        }

        $request->session()->put('keranjang', $keranjang);

        return back();
    }

    public function hapus(Request $request, $id)
    {
        $keranjang = $request->session()->get('keranjang', []);

        unset($keranjang[$id]);

        $request->session()->put('keranjang', $keranjang);

        return back()->with('pesan', 'Barang dihapus dari keranjang.');
    }

    public function kosongkan(Request $request)
    {
        $request->session()->forget('keranjang');

        return back()->with('pesan', 'Keranjang dikosongkan.');
    }
}