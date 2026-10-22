<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpusController;

Route::get('/login', [PerpusController::class, 'showLogin'])->name('login');
Route::post('/login', [PerpusController::class, 'login']);
Route::get('/logout', [PerpusController::class, 'logout']);

Route::get('/dashboard', [PerpusController::class, 'dashboard']);

// Route baru untuk Kelola Buku
Route::get('/kelola-buku', [PerpusController::class, 'kelolaIndex']);

Route::get('/buku/tambah', [PerpusController::class, 'create']);
Route::post('/buku/tambah', [PerpusController::class, 'store']);
Route::get('/buku/edit/{id}', [PerpusController::class, 'edit']);
Route::post('/buku/edit/{id}', [PerpusController::class, 'update']);

// Diubah dari Route::get menjadi Route::delete
Route::delete('/buku/hapus/{id}', [PerpusController::class, 'destroy']);

Route::get('/export-excel', [PerpusController::class, 'exportExcel']);
Route::get('/export-pdf', [PerpusController::class, 'exportPdf']);

// Endpoint JSON API sesuai jobsheet ujian praktik
Route::get('/api/books', [PerpusController::class, 'apiBooks']);

Route::get('/', function () {
    return redirect('/login');
});