<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.pasien', compact('user'));
    }
}

