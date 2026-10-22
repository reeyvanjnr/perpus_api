<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Perpus API</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { margin: 0; background: #f4f6f9; color: #333; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 500px;
            border: 1px solid #f1f2f6;
        }
        .card h2 { margin-top: 0; margin-bottom: 20px; font-size: 20px; color: #2d3436; display: flex; align-items: center; gap: 10px; }
        .card h2 i { color: #0984e3; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #636e72; margin-bottom: 6px; }
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }
        .form-group input:focus { border-color: #0984e3; }
        
        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
        .btn-submit {
            background: #0984e3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            flex: 1;
            transition: 0.2s;
        }
        .btn-submit:hover { opacity: 0.9; }
        
        .btn-back {
            background: #dfe6e9;
            color: #2d3436;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-back:hover { background: #b2bec3; }
    </style>
</head>
<body>

    <div class="card">
        <h2><i class="fa-solid fa-pen-to-square"></i> Edit Data Buku</h2>

        @if ($errors->any())
            <div style="background: #ffeaa7; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; color: #d63031;">
                <b>Terjadi Kesalahan:</b>
                <ul style="margin: 5px 0 0 15px; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/buku/edit/{{ $buku->id }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Buku</label>
                <input type="text" name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku) }}" required>
            </div>
            
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" required>
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', $buku->kategori) }}" required>
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
            </div>

            <div class="btn-container">
                <a href="/kelola-buku" class="btn-back">Kembali</a>
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>