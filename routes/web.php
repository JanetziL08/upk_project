<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepController;

// Asumsi Anda sudah memiliki middleware 'auth' untuk membatasi akses
// Pastikan Anda sudah login atau middleware 'auth' sudah dihilangkan sementara untuk testing
// Route::middleware(['auth'])->group(function () {
// Ini mendaftarkan rute untuk: /reseps, /reseps/create, /reseps (POST), /reseps/{id}
Route::resource('reseps', ResepController::class)->only([
    'index',
    'create',
    'store',
    'show',
    'edit', // Menampilkan formulir edit (GET /reseps/{id}/edit)
    'update' // Memproses pengiriman formulir edit (PUT/PATCH /reseps/{id})
]);

// Jika Anda ingin menguji tanpa login, Anda bisa taruh di luar middleware
// Route::resource('reseps', ResepController::class)->only(['index', 'create', 'store', 'show']);
