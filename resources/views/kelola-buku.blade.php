<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku - Perpus API</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { margin: 0; background: #f4f6f9; color: #333; display: flex; }
        
        .sidebar {
            width: 260px;
            background: #ffffff;
            height: 100vh;
            position: fixed;
            padding: 25px 20px;
            border-right: 1px solid #eaeaea;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar-top .logo {
            font-size: 20px;
            font-weight: 700;
            color: #6c5ce7;
            margin-bottom: 35px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .menu-label { font-size: 11px; text-transform: uppercase; color: #b2bec3; font-weight: 600; margin-bottom: 10px; letter-spacing: 0.5px; }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #636e72;
            padding: 12px 15px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }
        .sidebar a i { width: 20px; text-align: center; font-size: 15px; }
        .sidebar a:hover, .sidebar a.active {
            background: #f1f0ff;
            color: #6c5ce7;
        }

        .main {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            background: #f8f9fa;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .page-title h1 { font-size: 22px; color: #2d3436; margin: 0; }
        .page-title p { font-size: 13px; color: #636e72; margin: 5px 0 0; }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 14px;
            color: #2d3436;
        }
        .avatar {
            width: 38px;
            height: 38px;
            background: #6c5ce7;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }
        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 14px;
            border: 1px solid #f1f2f6;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #f1f0ff;
            color: #6c5ce7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .stat-box h4 { margin: 0; font-size: 12px; color: #b2bec3; text-transform: uppercase; }
        .stat-box p { margin: 5px 0 0; font-size: 20px; font-weight: 700; color: #2d3436; }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border: 1px solid #f1f2f6;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card-header h2 { font-size: 18px; margin: 0; color: #2d3436; }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
        }
        .search-box input {
            padding: 9px 15px 9px 36px;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
            background: #fafbfc;
            font-size: 13px;
            width: 220px;
            outline: none;
        }
        .search-box input:focus { border-color: #6c5ce7; background: #fff; }
        .search-box i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2bec3;
            font-size: 12px;
        }

        .btn-action {
            background: #0984e3;
            color: white;
            padding: 9px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.2s;
        }
        .btn-action:hover { opacity: 0.9; }
        .btn-success { background: #00b894; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 16px; text-align: left; font-size: 14px; border-bottom: 1px solid #f1f2f6; }
        th { color: #b2bec3; font-weight: 600; font-size: 12px; text-transform: uppercase; background: #fafbfc; }
        td { color: #2d3436; }
        tr:hover { background: #fcfcfc; }
        
        .badge {
            background: #e8f4fd;
            color: #0984e3;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .action-btns a {
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            margin-right: 8px;
        }
        .btn-edit { color: #0984e3; }
        .btn-delete { color: #d63031; cursor: pointer; background: none; border: none; padding: 0; font-family: inherit; font-size: 13px; font-weight: 600; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-top">
            <div class="logo">
                <i class="fa-solid fa-book-open"></i> PerpusAPI
            </div>
            <div class="menu-label">Menu Utama</div>
            <a href="/dashboard"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="/kelola-buku" class="active"><i class="fa-solid fa-layer-group"></i> Kelola Buku</a>
            <a href="/buku/tambah"><i class="fa-solid fa-circle-plus"></i> Tambah Buku</a>
            
            <div class="menu-label" style="margin-top: 25px;">Laporan & API</div>
            <a href="/export-excel" target="_blank"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
            <a href="/export-pdf" target="_blank"><i class="fa-solid fa-file-pdf"></i> Export PDF</a>
            <a href="/api/books" target="_blank"><i class="fa-solid fa-code"></i> Endpoint JSON API</a>
        </div>
        <div>
            <a href="/logout" id="btn-logout" style="color: #d63031;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="topbar">
            <div class="page-title">
                <h1>Kelola Data Buku</h1>
                <p>Pusat kontrol inventaris, rekapitulasi, dan laporan koleksi perpustakaan.</p>
            </div>
            <div class="user-profile">
                <div class="avatar">A</div>
                <span>Admin Perpustakaan</span>
            </div>
        </div>

        <!-- Ringkasan Statistik -->
        <div class="stats-row">
            <div class="stat-box">
                <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
                <div>
                    <h4>Total Koleksi</h4>
                    <p>{{ $total_buku }} Buku</p>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
                <div>
                    <h4>Total Kategori</h4>
                    <p>{{ $jml_kategori }} Kategori</p>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="fa-solid fa-user-pen"></i></div>
                <div>
                    <h4>Total Penulis</h4>
                    <p>{{ $jml_penulis }} Penulis</p>
                </div>
            </div>
        </div>

        <!-- Tabel Manajemen & Laporan -->
        <div class="content-card">
            <div class="card-header">
                <h2>Daftar Seluruh Inventaris Buku</h2>
                <div class="header-actions">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="inputPencarian" placeholder="Cari buku...">
                    </div>
                    <a href="/export-excel" target="_blank" class="btn-action btn-success"><i class="fa-solid fa-file-excel"></i> Excel</a>
                    <a href="/export-pdf" target="_blank" class="btn-action"><i class="fa-solid fa-file-pdf"></i> PDF</a>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabel-buku">
                    @foreach($buku as $index => $b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $b->kode_buku }}</strong></td>
                        <td>{{ $b->judul }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td><span class="badge">{{ $b->kategori }}</span></td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tahun_terbit }}</td>
                        <td class="action-btns">
                            <a href="/buku/edit/{{ $b->id }}" class="btn-edit">Edit</a>
                            <form action="/buku/hapus/{{ $b->id }}" method="POST" class="d-inline delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Fitur Search Sederhana di Halaman Kelola Buku
        document.getElementById("inputPencarian").addEventListener("keyup", function(e) {
            let keyword = e.target.value.toLowerCase();
            let rows = document.querySelectorAll("#tabel-buku tr");
            
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                if(text.includes(keyword)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // SweetAlert untuk Tombol Hapus
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-delete')) {
                e.preventDefault();
                const form = e.target.closest('form');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data buku yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        // SweetAlert untuk Konfirmasi Logout
        document.getElementById('btn-logout').addEventListener('click', function(e) {
            e.preventDefault();
            const logoutUrl = this.getAttribute('href');
            
            Swal.fire({
                title: 'Keluar Aplikasi?',
                text: "Apakah Anda yakin ingin keluar dari sesi ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6c5ce7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutUrl;
                }
            });
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    @endif

</body>
</html>