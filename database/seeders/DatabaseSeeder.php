<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert Admin (Username: admin, Password: admin123)
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert 10 Data Buku sesuai ketentuan jobsheet
        DB::table('books')->insert([
            [
                'kode_buku' => 'BK001',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'kategori' => 'Novel',
                'tahun_terbit' => 2005,
                'penerbit' => 'Bentang Pustaka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK002',
                'judul' => 'Bumi',
                'penulis' => 'Tere Liye',
                'kategori' => 'Novel',
                'tahun_terbit' => 2014,
                'penerbit' => 'Gramedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK003',
                'judul' => 'Pemrograman PHP',
                'penulis' => 'Abdul Kadir',
                'kategori' => 'Teknologi',
                'tahun_terbit' => 2020,
                'penerbit' => 'Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK004',
                'judul' => 'Belajar HTML dan CSS',
                'penulis' => 'Jubilee Enterprise',
                'kategori' => 'Teknologi',
                'tahun_terbit' => 2021,
                'penerbit' => 'Elex Media',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK005',
                'judul' => 'Dasar-Dasar JavaScript',
                'penulis' => 'Wahana Komputer',
                'kategori' => 'Teknologi',
                'tahun_terbit' => 2022,
                'penerbit' => 'Andi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK006',
                'judul' => 'Pulang',
                'penulis' => 'Tere Liye',
                'kategori' => 'Novel',
                'tahun_terbit' => 2015,
                'penerbit' => 'Republika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK007',
                'judul' => 'Negeri 5 Menara',
                'penulis' => 'A. Fuadi',
                'kategori' => 'Novel',
                'tahun_terbit' => 2009,
                'penerbit' => 'Gramedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK008',
                'judul' => 'Laravel Up & Running',
                'penulis' => 'Matt Stauffer',
                'kategori' => 'Teknologi',
                'tahun_terbit' => 2019,
                'penerbit' => 'O Reilly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK009',
                'judul' => 'Algoritma Pemrograman',
                'penulis' => 'Rinaldi Munir',
                'kategori' => 'Edukasi',
                'tahun_terbit' => 2011,
                'penerbit' => 'Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_buku' => 'BK010',
                'judul' => 'Sejarah Dunia Yang Disembunyikan',
                'penulis' => 'Jonathan Black',
                'kategori' => 'Sejarah',
                'tahun_terbit' => 2007,
                'penerbit' => 'Alvabet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}