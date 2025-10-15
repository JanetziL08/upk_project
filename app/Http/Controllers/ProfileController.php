<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            'password_changed' => true,
        ]);

        // 🔹 Tentukan redirect berdasarkan role
        if ($user->role === 'administrator') {
            return redirect()->route('dashboard.admin')->with('success', 'Password berhasil diubah!');
        } elseif ($user->role === 'dosen') {
            return redirect()->route('dashboard.dosen')->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->route('dashboard.mahasiswa')->with('success', 'Password berhasil diubah!');
        }


    }
}
