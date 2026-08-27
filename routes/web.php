<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Dashboard (setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    // Profile routes (default Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ===== ROUTE SURAT =====
    // Semua user login bisa lihat data
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat-masuk', [SuratController::class, 'suratMasuk'])->name('surat.masuk');
    Route::get('/surat-keluar', [SuratController::class, 'suratKeluar'])->name('surat.keluar');

    // ===== ROUTE YANG HANYA UNTUK ADMIN =====
    Route::middleware(['admin'])->group(function () {
        // CRUD Surat
        Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
        Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
        Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
        Route::put('/surat/{id}', [SuratController::class, 'update'])->name('surat.update');
        Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');

        // Log Aktivitas (hanya admin)
        Route::get('/log-aktivitas', [SuratController::class, 'activityLog'])->name('surat.log');
    });
});

require __DIR__ . '/auth.php';