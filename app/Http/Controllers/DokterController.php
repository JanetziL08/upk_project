<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.dokter', compact('user'));
    }
}
