<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\JadwalAcaraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // bisa diakses semua role yang login
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran/{acara}', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // admin + panitia — ubah status pendaftaran
    Route::middleware('cek.role:admin,panitia')->group(function () {
        Route::patch('/pendaftaran/{pendaftaran}/status', [PendaftaranController::class, 'updateStatus'])
            ->name('pendaftaran.updateStatus');
    });

    // khusus admin — daftarkan SEBELUM route show/index publik acara
    Route::middleware('cek.role:admin')->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('acara', AcaraController::class)->except(['index', 'show']);
        Route::resource('panitia', PanitiaController::class)->only(['index', 'create', 'store', 'destroy']);

        Route::post('/acara/{acara}/jadwal', [JadwalAcaraController::class, 'store'])->name('jadwal.store');
        Route::delete('/jadwal/{jadwal}', [JadwalAcaraController::class, 'destroy'])->name('jadwal.destroy');
    });

    // bisa dilihat semua role yang login — daftarkan SETELAH admin
    Route::resource('acara', AcaraController::class)->only(['index', 'show']);
});

require __DIR__.'/auth.php';