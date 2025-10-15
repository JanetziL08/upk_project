<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rekamMedisController;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/rekam-medis/{id_pasien}/terapi', [rekamMedisController::class, 'inputTerapi'])
    ->name('rekam-medis.input-terapi');

Route::get('/rekam-medis/tes-terapi', function () {
    return view('input_terapi');
});
