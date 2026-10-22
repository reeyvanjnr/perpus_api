<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Perpus API</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { margin: 0; background: #f8f9fa; color: #333; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .form-card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: 1px solid #f1f2f6;
        }
        h2 { font-size: 20px; font-weight: 700; color: #2d3436; margin-bottom: 25px; margin-top: 0; }
        label { font-size: 13px; font-weight: 600; color: #636e72; display: block; margin-bottom: 8px; }
        input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #dfe6e9;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: #fafbfc;
            transition: 0.2s;
        }
        input:focus { border-color: #6c5ce7; background: #fff; }
        .btn-group { display: flex; gap: 10px; align-items: center; margin-top: 10px; }
        button {
            background: #6c5ce7;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.2);
            transition: 0.2s;
        }
        button:hover { background: #5b4cc4; }
        .btn-back {
            color: #636e72;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 15px;
        }
        .btn-back:hover { color: #2d3436; }
    </style>
</head>
<body>
    <div class="form-card">
        <h2>Form Tambah Buku Baru</h2>
        <form method="POST" action="/buku/tambah">
            @csrf
            <label>Kode Buku</label>
            <input type="text" name="kode_buku" required placeholder="Contoh: BK011">

            <label>Judul Buku</label>
            <input type="text" name="judul" required placeholder="Masukkan judul buku">

            <label>Penulis</label>
            <input type="text" name="penulis" required placeholder="Nama penulis">

            <label>Kategori</label>
            <input type="text" name="kategori" required placeholder="Contoh: Novel / Teknologi">

            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" required placeholder="Contoh: 2024">

            <label>Penerbit</label>
            <input type="text" name="penerbit" required placeholder="Nama penerbit">

            <div class="btn-group">
                <button type="submit">Simpan Data</button>
                <a href="/dashboard" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>