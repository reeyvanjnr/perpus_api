<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Buku</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #333; padding: 6px 8px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>Laporan Data Buku Perpustakaan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Penerbit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $index => $b)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $b->kode_buku }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->penulis }}</td>
                <td>{{ $b->kategori }}</td>
                <td style="text-align: center;">{{ $b->tahun_terbit }}</td>
                <td>{{ $b->penerbit }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>