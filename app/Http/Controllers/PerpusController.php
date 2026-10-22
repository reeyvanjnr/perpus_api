<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerpusController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::login($admin);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function dashboard()
    {
        $buku = Book::all();
        $total_buku = $buku->count();
        $jml_kategori = $buku->unique('kategori')->count();
        $jml_penulis = $buku->unique('penulis')->count();
        $tahun_terbaru = $buku->max('tahun_terbit');

        return view('dashboard', compact('total_buku', 'jml_kategori', 'jml_penulis', 'tahun_terbaru'));
    }

    public function kelolaIndex()
    {
        $buku = Book::all();
        $total_buku = $buku->count();
        $jml_kategori = $buku->unique('kategori')->count();
        $jml_penulis = $buku->unique('penulis')->count();
        
        return view('kelola-buku', compact('buku', 'total_buku', 'jml_kategori', 'jml_penulis'));
    }

    public function create()
    {
        return view('buku.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:books',
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required',
        ]);

        Book::create($request->all());

        return redirect('/dashboard')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Book::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Book::findOrFail($id);
        
        $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $id,
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required',
        ]);

        $buku->update($request->all());

        return redirect('/dashboard')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        $buku->delete();

        return redirect('/dashboard')->with('success', 'Buku berhasil dihapus!');
    }

    public function exportExcel()
    {
        $buku = Book::all();
        $filename = "laporan-data-buku-" . date('Y-m-d') . ".xls";

        $output = "<table>";
        $output .= "<tr><th>No</th><th>Kode Buku</th><th>Judul Buku</th><th>Penulis</th><th>Kategori</th><th>Tahun Terbit</th><th>Penerbit</th></tr>";
        
        foreach($buku as $no => $b) {
            $output .= "<tr>";
            $output .= "<td>".($no+1)."</td>";
            $output .= "<td>'{$b->kode_buku}</td>";
            $output .= "<td>{$b->judul}</td>";
            $output .= "<td>{$b->penulis}</td>";
            $output .= "<td>{$b->kategori}</td>";
            $output .= "<td>{$b->tahun_terbit}</td>";
            $output .= "<td>{$b->penerbit}</td>";
            $output .= "</tr>";
        }
        $output .= "</table>";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        echo $output;
        exit;
    }

    public function exportPdf()
    {
        $buku = Book::all();
        return view('buku.pdf', compact('buku'));
    }

    public function apiBooks()
    {
        $buku = Book::all();
        return response()->json($buku);
    }
}