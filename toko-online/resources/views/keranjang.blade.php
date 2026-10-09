<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>

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

        .produk {
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
        }

        .tombol {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            padding: 8px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .merah {
            background: #dc2626;
        }

        a {
            color: #2563eb;
        }

        .pesan {
            background: #e0f2fe;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <h1>Keranjang Belanja</h1>

        <p>Pembeli: {{ auth()->user()->nama_lengkap }}</p>

        <a href="{{ route('barang.index') }}">
            Kembali ke daftar barang
        </a>

        <hr>

        @if (session('pesan'))
            <p class="pesan">{{ session('pesan') }}</p>
        @endif

        @if ($errors->any())
            <p class="pesan">{{ $errors->first() }}</p>
        @endif

        @if ($produk->isEmpty())
            <p>Keranjang masih kosong.</p>
        @else
            @foreach ($produk as $item)
                <div class="produk">
                    <h3>{{ $item->nama_barang }}</h3>

                    <p>Stok tersedia: {{ $item->stok }}</p>

                    <p>
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                        × {{ $keranjang[$item->id_barang] }}
                        =
                        Rp {{ number_format(
                            $item->harga * $keranjang[$item->id_barang],
                            0,
                            ',',
                            '.'
                        ) }}
                    </p>

                    <div class="tombol">
                        <form
                            action="{{ route('keranjang.kurang', $item->id_barang) }}"
                            method="POST"
                        >
                            @csrf
                            <button type="submit">−</button>
                        </form>

                        <span>{{ $keranjang[$item->id_barang] }}</span>

                        <form
                            action="{{ route('keranjang.tambah', $item->id_barang) }}"
                            method="POST"
                        >
                            @csrf
                            <button type="submit">+</button>
                        </form>

                        <form
                            action="{{ route('keranjang.hapus', $item->id_barang) }}"
                            method="POST"
                        >
                            @csrf
                            <button type="submit" class="merah">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <h2>
                Total: Rp {{ number_format($total, 0, ',', '.') }}
            </h2>

            <form
                action="{{ route('keranjang.kosongkan') }}"
                method="POST"
            >
                @csrf
                <button type="submit" class="merah">
                    Kosongkan keranjang
                </button>
            </form>

            <p>
                Alamat pengiriman: {{ auth()->user()->alamat }}
            </p>

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit">Checkout</button>
            </form>
        @endif
    </div>
</body>
</html>