<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    // Method untuk halaman Dashboard
    public function dashboard()
    {
        $buku = Buku::all();
        $total_buku = $buku->count();
        $jml_kategori = $buku->unique('kategori')->count();
        $jml_penulis = $buku->unique('penulis')->count();
        $tahun_terbaru = $buku->max('tahun_terbit');

        return view('dashboard', compact('total_buku', 'jml_kategori', 'jml_penulis', 'tahun_terbaru'));
    }

    // Method baru untuk halaman Kelola Buku
    public function kelolaIndex()
    {
        $buku = Buku::all();
        $total_buku = $buku->count();
        $jml_kategori = $buku->unique('kategori')->count();
        $jml_penulis = $buku->unique('penulis')->count();
        
        return view('kelola-buku', compact('buku', 'total_buku', 'jml_kategori', 'jml_penulis'));
    }

    // Method API untuk Fetch JSON
    public function apiBooks()
    {
        $buku = Buku::all();
        return response()->json($buku);
    }

    // Method lainnya (Login, Tambah, Edit, Hapus, Export) tetap disesuaikan dengan kode yang sudah ada di project kamu
}