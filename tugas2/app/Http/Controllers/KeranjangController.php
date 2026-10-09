<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index(Request $request)
    {
        $barang = Barang::all();
        $keranjang = $request->session()->get('keranjang', []);

        $jumlahItem = array_sum($keranjang);

        return view('barang', compact('barang', 'jumlahItem'));
    }

    public function keranjang(Request $request)
    {
        $keranjang = $request->session()->get('keranjang', []);

        $daftarBarang = Barang::whereIn(
            'id',
            array_keys($keranjang)
        )->get();

        $total = 0;

        foreach ($daftarBarang as $barang) {
            $total += $barang->harga * $keranjang[$barang->id];
        }

        return view(
            'keranjang',
            compact('keranjang', 'daftarBarang', 'total')
        );
    }

    public function tambah(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = $request->session()->get('keranjang', []);

        $jumlah = $keranjang[$id] ?? 0;

        if ($jumlah >= $barang->stok) {
            return back()->with('pesan', 'Jumlah melebihi stok barang.');
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