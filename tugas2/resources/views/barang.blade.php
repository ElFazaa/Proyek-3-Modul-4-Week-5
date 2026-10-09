<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>

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

        .atas {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .produk {
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
        }

        button {
            background: #2563eb;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:disabled {
            background: #999;
            cursor: default;
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
        <div class="atas">
            <h1>Toko Alat Tulis</h1>

            <a href="{{ route('keranjang.index') }}">
                Keranjang ({{ $jumlahItem }})
            </a>
        </div>

        <hr>

        @if (session('pesan'))
            <p class="pesan">{{ session('pesan') }}</p>
        @endif

        <h2>Daftar Barang</h2>

        @foreach ($barang as $item)
            <div class="produk">
                <h3>{{ $item->nama }}</h3>

                <p>
                    Harga:
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </p>

                <p>Stok: {{ $item->stok }}</p>

                <form
                    action="{{ route('keranjang.tambah', $item->id) }}"
                    method="POST"
                >
                    @csrf

                    @if ($item->stok > 0)
                        <button type="submit">
                            Masukkan ke keranjang
                        </button>
                    @else
                        <button type="submit" disabled>
                            Stok habis
                        </button>
                    @endif
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>