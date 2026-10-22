<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Buku Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 13px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body onload="window.print()">
    <h2>LAPORAN DATA BUKU PERPUSTAKAAN</h2>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>KODE BUKU</th>
                <th>JUDUL</th>
                <th>PENULIS</th>
                <th>KATEGORI</th>
                <th>TAHUN</th>
                <th>PENERBIT</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($books as $b)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $b->kode_buku }}</td>
                <td>{{ $b->judul }}</td>
                <td>{{ $b->penulis }}</td>
                <td>{{ $b->kategori }}</td>
                <td>{{ $b->tahun_terbit }}</td>
                <td>{{ $b->penerbit }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>