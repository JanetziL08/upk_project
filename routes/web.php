<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\pendaftaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rekamMedisController;

Route::get('/', function () {
    return view('welcome');
});

