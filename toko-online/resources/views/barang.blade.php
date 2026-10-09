<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }

        .kotak {
            max-width: 900px;
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

        .menu {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .produk {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
            flex-wrap: wrap;
        }

        .gambar {
            width: 140px;
            height: 140px;
            object-fit: contain;
        }

        .tanpa-gambar {
            width: 140px;
            height: 140px;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #666;
        }

        button {
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:disabled {
            background: #999;
            cursor: default;
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
        <div class="atas">
            <h1>Toko Alat Tulis</h1>

            <div class="menu">
                @auth
                    <span>
                        Halo, {{ auth()->user()->nama_lengkap }}
                    </span>

                    <a href="{{ route('keranjang.index') }}">
                        Keranjang ({{ $jumlahItem }})
                    </a>

                    <a href="{{ route('riwayat.index') }}">
                        Riwayat Pesanan
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="merah">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </div>

        <hr>

        @if (session('pesan'))
            <p class="pesan">{{ session('pesan') }}</p>
        @endif

        <h2>Daftar Barang</h2>

        @foreach ($produk as $item)
            <div class="produk">
                @if (is_file(public_path('gambar/' . $item->gambar)))
                    <img
                        src="{{ asset('gambar/' . $item->gambar) }}"
                        alt="{{ $item->nama_barang }}"
                        class="gambar"
                    >
                @else
                    <div class="tanpa-gambar">
                        Gambar belum tersedia
                    </div>
                @endif

                <div>
                    <h3>{{ $item->nama_barang }}</h3>

                    <p>{{ $item->deskripsi }}</p>

                    <p>
                        Harga:
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>

                    <p>Stok: {{ $item->stok }}</p>

                    @if ($item->stok == 0)
                        <button type="button" disabled>
                            Stok habis
                        </button>
                    @else
                        @auth
                            <form
                                action="{{ route('keranjang.tambah', $item->id_barang) }}"
                                method="POST"
                            >
                                @csrf
                                <button type="submit">
                                    Masukkan ke keranjang
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">
                                Login untuk membeli
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>