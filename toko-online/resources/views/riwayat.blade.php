<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }

        .kotak {
            max-width: 800px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        .pesanan {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        a {
            color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <h1>Riwayat Pesanan</h1>

        <p>Pembeli: {{ auth()->user()->nama_lengkap }}</p>

        <a href="{{ route('barang.index') }}">
            Kembali ke daftar barang
        </a>

        @forelse ($pesanan as $order)
            <div class="pesanan">
                <h2>Pesanan {{ $order->id_order }}</h2>

                <p>Tanggal: {{ $order->tanggal_order }}</p>

                <p>
                    Alamat pengiriman:
                    {{ $order->alamat_pengiriman }}
                </p>

                <h3>Barang yang dibeli</h3>

                <ul>
                    @foreach ($detail[$order->id_order] ?? [] as $item)
                        <li>
                            {{ $item->nama_barang }}
                            —
                            Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                            × {{ $item->jumlah_beli }}
                            =
                            Rp {{ number_format(
                                $item->harga_satuan * $item->jumlah_beli,
                                0,
                                ',',
                                '.'
                            ) }}
                        </li>
                    @endforeach
                </ul>

                <strong>
                    Total:
                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                </strong>
            </div>
        @empty
            <p>Belum ada pesanan. Silakan belanja dan lakukan checkout.</p>
        @endforelse
    </div>
</body>
</html>