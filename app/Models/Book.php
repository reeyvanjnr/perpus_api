<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    
    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'kategori',
        'tahun_terbit',
        'penerbit'
    ];
}