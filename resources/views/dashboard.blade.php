<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perpus API</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Chart.js CDN untuk Grafik Statistik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * { box-sizing: border-box; font-family: 'Inter', sans-serif; transition: background 0.3s, color 0.3s, border-color 0.3s; }
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
            z-index: 10;
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
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 25px;
        }
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

        .hero-banner {
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
            border-radius: 20px;
            padding: 30px 40px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(108, 92, 231, 0.15);
        }
        .hero-banner h1 { margin: 0 0 10px 0; font-size: 24px; }
        .hero-banner p { margin: 0; font-size: 14px; opacity: 0.9; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border: 1px solid #f1f2f6;
        }
        .stat-card h3 { font-size: 12px; color: #b2bec3; margin: 0; font-weight: 600; }
        .stat-card p { font-size: 22px; font-weight: 700; color: #2d3436; margin: 8px 0 0; }

        .chart-container-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            border: 1px solid #f1f2f6;
        }
        .chart-container-box h3 {
            font-size: 16px;
            color: #2d3436;
            margin-top: 0;
            margin-bottom: 15px;
        }

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
            gap: 15px;
            flex-wrap: wrap;
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
        .search-box input, .search-box select {
            padding: 10px 15px;
            border-radius: 10px;
            border: 1px solid #dfe6e9;
            background: #fafbfc;
            font-size: 13px;
            outline: none;
            color: #333;
        }
        .search-box input {
            padding-left: 38px;
            width: 180px;
        }
        .search-box input:focus, .search-box select:focus { border-color: #6c5ce7; background: #fff; }
        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2bec3;
            font-size: 13px;
        }

        .btn-primary {
            background: #6c5ce7;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(108, 92, 231, 0.2);
            display: flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover { background: #5b4cc4; }

        .btn-secondary {
            background: #dfe6e9;
            color: #2d3436;
            padding: 10px 14px;
            border-radius: 10px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-secondary:hover { background: #b2bec3; color: white; }

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
        
        .action-btns a, .action-btns button {
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            margin-right: 10px;
            background: none;
            border: none;
            padding: 0;
            font-family: inherit;
            cursor: pointer;
        }
        .btn-edit { color: #0984e3; }
        .btn-delete { color: #d63031; }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 13px;
            color: #636e72;
        }
        .pagination-btns {
            display: flex;
            gap: 5px;
        }
        .page-btn {
            padding: 6px 12px;
            border: 1px solid #dfe6e9;
            background: #fff;
            color: #333;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        .page-btn:hover { background: #f1f0ff; color: #6c5ce7; border-color: #6c5ce7; }
        .page-btn.active { background: #6c5ce7; color: #fff; border-color: #6c5ce7; }
        .page-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        /* --- CSS MODAL POPUP --- */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-box {
            background: white;
            width: 500px;
            max-width: 90%;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }
        .modal-overlay.active .modal-box {
            transform: translateY(0);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .modal-header h3 { margin: 0; font-size: 18px; color: #2d3436; }
        .close-modal { background: none; border: none; font-size: 18px; cursor: pointer; color: #b2bec3; }
        .close-modal:hover { color: #d63031; }
        
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #636e72;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
            font-size: 14px;
            outline: none;
        }
        .form-group input:focus { border-color: #6c5ce7; }

        /* --- DARK MODE STYLING --- */
        body.dark-mode {
            background: #121212;
            color: #e0e0e0;
        }
        body.dark-mode .sidebar {
            background: #1e1e1e;
            border-right: 1px solid #2d2d2d;
        }
        body.dark-mode .sidebar a { color: #a0a0a0; }
        body.dark-mode .sidebar a:hover, body.dark-mode .sidebar a.active {
            background: #2b2640;
            color: #a29bfe;
        }
        body.dark-mode .main { background: #181818; }
        body.dark-mode .stat-card, 
        body.dark-mode .chart-container-box, 
        body.dark-mode .content-card,
        body.dark-mode .modal-box {
            background: #1e1e1e;
            border-color: #2d2d2d;
        }
        body.dark-mode .stat-card h3, 
        body.dark-mode .chart-container-box h3,
        body.dark-mode .card-header h2,
        body.dark-mode .stat-card p,
        body.dark-mode .modal-header h3 {
            color: #ffffff;
        }
        body.dark-mode th {
            background: #252525;
            color: #a0a0a0;
            border-bottom: 1px solid #2d2d2d;
        }
        body.dark-mode td {
            color: #e0e0e0;
            border-bottom: 1px solid #2d2d2d;
        }
        body.dark-mode tr:hover { background: #222222; }
        body.dark-mode .search-box input, 
        body.dark-mode .search-box select,
        body.dark-mode .form-group input {
            background: #252525;
            border-color: #333;
            color: #fff;
        }
        body.dark-mode .page-btn {
            background: #1e1e1e;
            border-color: #333;
            color: #e0e0e0;
        }
        body.dark-mode .page-btn.active {
            background: #6c5ce7;
            color: #fff;
        }
        body.dark-mode .btn-secondary {
            background: #333;
            color: #fff;
        }
        body.dark-mode .user-profile span { color: #e0e0e0; }
    </style>
</head>
<body id="bodyTag">

    <div class="sidebar">
        <div class="sidebar-top">
            <div class="logo">
                <i class="fa-solid fa-book-open"></i> PerpusAPI
            </div>
            <div class="menu-label">Menu Utama</div>
            <a href="/dashboard" class="active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="/kelola-buku"><i class="fa-solid fa-layer-group"></i> Kelola Buku</a>
            <a href="#" id="openModalBtn"><i class="fa-solid fa-circle-plus"></i> Tambah Buku</a>
            
            <div class="menu-label" style="margin-top: 25px;">Laporan & API</div>
            <a href="/export-excel" target="_blank"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
            <a href="/export-pdf" target="_blank"><i class="fa-solid fa-file-pdf"></i> Export PDF</a>
            <a href="/api/books" target="_blank"><i class="fa-solid fa-code"></i> Endpoint JSON API</a>

            <div class="menu-label" style="margin-top: 25px;">Pengaturan</div>
            <a href="#" id="darkModeToggle"><i class="fa-solid fa-moon"></i> <span id="darkModeText">Dark Mode</span></a>
        </div>
        <div>
            <a href="/logout" id="btn-logout" style="color: #d63031;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH BUKU -->
    <div class="modal-overlay" id="modalTambah">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Buku Baru</h3>
                <button type="button" class="close-modal" id="closeModalBtn">&times;</button>
            </div>
            <form action="/buku/tambah" method="POST">
                @csrf
                <div class="form-group">
                    <label>Kode Buku</label>
                    <input type="text" name="kode_buku" required placeholder="Contoh: BK011">
                </div>
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" required placeholder="Judul buku...">
                </div>
                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulis" required placeholder="Nama penulis...">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" required placeholder="Kategori buku...">
                </div>
                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" required placeholder="2026">
                </div>
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" required placeholder="Nama penerbit...">
                </div>
                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" class="btn-secondary" id="cancelModalBtn">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div class="user-profile">
                <div class="avatar">A</div>
                <span>Admin Perpustakaan</span>
            </div>
        </div>

        <div class="hero-banner">
            <div>
                <h1>Selamat Datang di Sistem Perpustakaan Modern</h1>
                <p>Kelola data buku, pantau statistik koleksi, dan akses REST API dengan mudah dan cepat.</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>TOTAL BUKU</h3>
                <p>{{ $total_buku }}</p>
            </div>
            <div class="stat-card">
                <h3>KATEGORI</h3>
                <p>{{ $jml_kategori }}</p>
            </div>
            <div class="stat-card">
                <h3>DATA PENULIS</h3>
                <p>{{ $jml_penulis }}</p>
            </div>
            <div class="stat-card">
                <h3>TERBIT TERBARU</h3>
                <p>{{ $tahun_terbaru }}</p>
            </div>
        </div>

        <!-- Bagian Grafik Statistik -->
        <div class="chart-container-box">
            <h3><i class="fa-solid fa-chart-bar" style="color: #6c5ce7; margin-right: 8px;"></i> Grafik Distribusi Buku Berdasarkan Kategori</h3>
            <div style="position: relative; height: 250px; width: 100%;">
                <canvas id="grafikKategori"></canvas>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header">
                <h2>Katalog Buku (Fetch API)</h2>
                <div class="header-actions">
                    <!-- Dropdown Filter Kategori -->
                    <div class="search-box">
                        <select id="filterKategori">
                            <option value="">Semua Kategori</option>
                        </select>
                    </div>

                    <!-- Dropdown Sorting Tahun -->
                    <div class="search-box">
                        <select id="sortTahun">
                            <option value="">Urutkan Tahun</option>
                            <option value="terbaru">Tahun: Terbaru ke Lama</option>
                            <option value="terlama">Tahun: Lama ke Terbaru</option>
                        </select>
                    </div>

                    <!-- Input Pencarian -->
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="inputPencarian" placeholder="Cari judul...">
                    </div>

                    <!-- Tombol Reset Filter -->
                    <button type="button" class="btn-secondary" id="btnReset" title="Reset Filter"><i class="fa-solid fa-rotate-right"></i></button>

                    <button type="button" class="btn-primary" id="openModalMainBtn"><i class="fa-solid fa-plus"></i> Tambah Buku</button>
                </div>
            </div>
            
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabel-buku">
                    <!-- Data dimuat secara dinamis via JavaScript -->
                </tbody>
            </table>

            <!-- Navigasi Pagination -->
            <div class="pagination-container">
                <div id="pagination-info">Menampilkan data...</div>
                <div class="pagination-btns" id="pagination-controls"></div>
            </div>
        </div>
    </div>

    <script>
        let semuaBuku = [];
        let currentPage = 1;
        let rowsPerPage = 5;
        let myChart = null;

        // --- SCRIPT MODAL POPUP ---
        const modalTambah = document.getElementById('modalTambah');
        const openModalBtn = document.getElementById('openModalBtn');
        const openModalMainBtn = document.getElementById('openModalMainBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelModalBtn = document.getElementById('cancelModalBtn');

        function bukaModal() { modalTambah.classList.add('active'); }
        function tutupModal() { modalTambah.classList.remove('active'); }

        openModalBtn.addEventListener('click', (e) => { e.preventDefault(); bukaModal(); });
        openModalMainBtn.addEventListener('click', (e) => { e.preventDefault(); bukaModal(); });
        closeModalBtn.addEventListener('click', tutupModal);
        cancelModalBtn.addEventListener('click', tutupModal);
        modalTambah.addEventListener('click', (e) => { if(e.target === modalTambah) tutupModal(); });

        // --- SCRIPT DARK MODE ---
        const darkModeToggle = document.getElementById('darkModeToggle');
        const bodyTag = document.getElementById('bodyTag');
        const darkModeText = document.getElementById('darkModeText');

        if (localStorage.getItem('theme') === 'dark') {
            bodyTag.classList.add('dark-mode');
            darkModeText.innerText = 'Light Mode';
            darkModeToggle.querySelector('i').className = 'fa-solid fa-sun';
        }

        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            bodyTag.classList.toggle('dark-mode');

            if (bodyTag.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                darkModeText.innerText = 'Light Mode';
                darkModeToggle.querySelector('i').className = 'fa-solid fa-sun';
            } else {
                localStorage.setItem('theme', 'light');
                darkModeText.innerText = 'Dark Mode';
                darkModeToggle.querySelector('i').className = 'fa-solid fa-moon';
            }
        });

        function renderTabelDanPagination(data) {
            let totalData = data.length;
            let totalPages = Math.ceil(totalData / rowsPerPage) || 1;

            if (currentPage > totalPages) {
                currentPage = totalPages;
            }

            let start = (currentPage - 1) * rowsPerPage;
            let paginatedData = data.slice(start, start + rowsPerPage);

            let output = "";
            if (totalData === 0) {
                output = `<tr><td colspan="8" style="text-align: center; color: #b2bec3; padding: 25px;">Data buku tidak ditemukan</td></tr>`;
            } else {
                let no = start + 1;
                paginatedData.forEach(buku => {
                    output += `
                        <tr>
                            <td>${no++}</td>
                            <td><strong>${buku.kode_buku}</strong></td>
                            <td>${buku.judul}</td>
                            <td>${buku.penulis}</td>
                            <td><span class="badge">${buku.kategori}</span></td>
                            <td>${buku.tahun_terbit}</td>
                            <td>${buku.penerbit}</td>
                            <td class="action-btns">
                                <a href="/buku/edit/${buku.id}" class="btn-edit">Edit</a>
                                <form action="/buku/hapus/${buku.id}" method="POST" class="d-inline delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
            }
            document.getElementById("tabel-buku").innerHTML = output;

            let end = Math.min(start + rowsPerPage, totalData);
            document.getElementById("pagination-info").innerText = totalData === 0 ? 
                "Tidak ada data" : `Menampilkan ${start + 1} - ${end} dari ${totalData} buku`;

            let controlsHTML = "";
            controlsHTML += `<button class="page-btn" onclick="ubahHalaman(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>&laquo; Prev</button>`;
            
            for (let i = 1; i <= totalPages; i++) {
                controlsHTML += `<button class="page-btn ${i === currentPage ? 'active' : ''}" onclick="ubahHalaman(${i})">${i}</button>`;
            }

            controlsHTML += `<button class="page-btn" onclick="ubahHalaman(${currentPage + 1})" ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}>Next &raquo;</button>`;
            
            document.getElementById("pagination-controls").innerHTML = controlsHTML;
        }

        function renderGrafik(data) {
            let kategoriCount = {};
            data.forEach(buku => {
                let kat = buku.kategori || 'Lainnya';
                kategoriCount[kat] = (kategoriCount[kat] || 0) + 1;
            });

            let labels = Object.keys(kategoriCount);
            let values = Object.values(kategoriCount);

            let ctx = document.getElementById('grafikKategori').getContext('2d');
            
            if (myChart) {
                myChart.destroy();
            }

            let isDark = bodyTag.classList.contains('dark-mode');

            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Buku',
                        data: values,
                        backgroundColor: '#6c5ce7',
                        borderRadius: 8,
                        barThickness: 35
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { 
                                stepSize: 1,
                                color: isDark ? '#a0a0a0' : '#666'
                            },
                            grid: { color: isDark ? '#2d2d2d' : '#eee' }
                        },
                        x: {
                            ticks: { color: isDark ? '#a0a0a0' : '#666' },
                            grid: { display: false }
                        }
                    }
                }
            });
        }

        let hasilFilterGlobal = [];

        function ubahHalaman(page) {
            currentPage = page;
            renderTabelDanPagination(hasilFilterGlobal);
        }

        function populateKategoriDropdown(data) {
            let kategoriSet = [...new Set(data.map(b => b.kategori))];
            let selectKategori = document.getElementById("filterKategori");
            
            selectKategori.innerHTML = '<option value="">Semua Kategori</option>';
            
            kategoriSet.forEach(kat => {
                if(kat) {
                    let option = document.createElement("option");
                    option.value = kat;
                    option.textContent = kat;
                    selectKategori.appendChild(option);
                }
            });
        }

        function prosesFilterDanUrutkan() {
            let keyword = document.getElementById("inputPencarian").value.toLowerCase();
            let kategoriPilihan = document.getElementById("filterKategori").value;
            let sortOrder = document.getElementById("sortTahun").value;

            currentPage = 1;

            let hasil = semuaBuku.filter(buku => {
                let cocokKeyword = buku.judul.toLowerCase().includes(keyword) ||
                                   buku.penulis.toLowerCase().includes(keyword) ||
                                   buku.kode_buku.toLowerCase().includes(keyword);
                
                let cocokKategori = kategoriPilihan === "" || buku.kategori === kategoriPilihan;

                return cocokKeyword && cocokKategori;
            });

            if (sortOrder === "terbaru") {
                hasil.sort((a, b) => b.tahun_terbit - a.tahun_terbit);
            } else if (sortOrder === "terlama") {
                hasil.sort((a, b) => a.tahun_terbit - b.tahun_terbit);
            }

            hasilFilterGlobal = hasil;
            renderTabelDanPagination(hasilFilterGlobal);
        }

        // Fetch Data Awal dari API
        fetch("/api/books")
            .then(response => response.json())
            .then(data => {
                semuaBuku = data;
                hasilFilterGlobal = data;
                populateKategoriDropdown(semuaBuku);
                renderTabelDanPagination(hasilFilterGlobal);
                renderGrafik(semuaBuku);
            })
            .catch(error => console.error("Gagal mengambil data API:", error));

        // Event Listeners
        document.getElementById("inputPencarian").addEventListener("keyup", prosesFilterDanUrutkan);
        document.getElementById("filterKategori").addEventListener("change", prosesFilterDanUrutkan);
        document.getElementById("sortTahun").addEventListener("change", prosesFilterDanUrutkan);

        // Tombol Reset Filter
        document.getElementById("btnReset").addEventListener("click", function() {
            document.getElementById("inputPencarian").value = "";
            document.getElementById("filterKategori").value = "";
            document.getElementById("sortTahun").value = "";
            currentPage = 1;
            hasilFilterGlobal = semuaBuku;
            renderTabelDanPagination(hasilFilterGlobal);
        });

        // SweetAlert untuk Tombol Hapus (Dinamis)
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