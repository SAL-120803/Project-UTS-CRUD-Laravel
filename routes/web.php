<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// ==========================
// 📤 EXPORT & 📥 IMPORT FILE
// ==========================
Route::get('/mahasiswa/pdf', [MahasiswaController::class, 'exportPdf'])->name('mahasiswa.exportPdf');
Route::get('/mahasiswa/excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.exportExcel');

// ==========================
// 🧩 CRUD MAHASISWA
// ==========================
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
