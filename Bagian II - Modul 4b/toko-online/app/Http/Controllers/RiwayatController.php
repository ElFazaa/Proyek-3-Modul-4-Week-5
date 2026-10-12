<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $pesanan = Order::where('id_user', $request->user()->id_user)
            ->orderByDesc('tanggal_order')
            ->get();

        $detail = DB::table('order_details')
            ->join(
                'products',
                'order_details.id_barang',
                '=',
                'products.id_barang'
            )
            ->whereIn('order_details.id_order', $pesanan->pluck('id_order'))
            ->select('order_details.*', 'products.nama_barang')
            ->get()
            ->groupBy('id_order');

        return view('riwayat', compact('pesanan', 'detail'));
    }
}