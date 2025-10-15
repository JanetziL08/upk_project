<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\pendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
});
Route::middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/pasien/dashboard', [PasienController::class, 'index'])->name('pasien.dashboard');
});

// 🟢 1. Input waktu pendaftaran
Route::match(['get', 'post'], '/pendaftaran/input', [pendaftaranController::class, 'inputPendaftaran'])
    ->name('pendaftaran.input');

// 🟢 2. Input keterangan tambahan
Route::match(['get', 'post'], '/pendaftaran/keterangan/{id}', [pendaftaranController::class, 'inputKeterangan'])
    ->name('pendaftaran.inputKeterangan');

// 🟢 3. Input biodata pasien
Route::match(['get', 'post'], '/pendaftaran/biodata/{id}', [pendaftaranController::class, 'inputBiodata'])
    ->name('pendaftaran.inputBiodata');

// 🟢 4. Menampilkan daftar pendaftaran pasien
Route::get('/pendaftaran/daftar', [PendaftaranController::class, 'tampilPendaftaranTersimpan'])
    ->name('pendaftaran.tampil');

// 🟢 5. Edit pendaftaran (kalau status masih “Menunggu Konfirmasi”)
Route::match(['get', 'post'], '/pendaftaran/edit/{id}', [pendaftaranController::class, 'editPendaftaran'])
    ->name('pendaftaran.edit');

// 🟢 6. Hapus pendaftaran (kalau status masih “Menunggu Konfirmasi”)
Route::match(['get', 'post'], '/pendaftaran/hapus/{id}', [pendaftaranController::class, 'hapusPendaftaran'])
    ->name('pendaftaran.hapus');

require __DIR__ . '/auth.php';
