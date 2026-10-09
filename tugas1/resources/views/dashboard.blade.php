<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }

        .kotak {
            max-width: 500px;
            margin: 60px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        button {
            padding: 10px 20px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <h1>Dashboard</h1>
        <hr>

        <h2>Selamat datang, {{ auth()->user()->nama_lengkap }}!</h2>

        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: {{ auth()->user()->username }}</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>