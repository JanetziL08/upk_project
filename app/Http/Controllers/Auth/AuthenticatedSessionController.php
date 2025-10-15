<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek apakah user belum ubah password
            if (!$user->password_changed) {
                return redirect()->route('profile.edit')
                    ->with('warning', 'Silakan ubah password Anda untuk keamanan.');
            }

            // Redirect ke dashboard sesuai role
            return match ($user->role) {
                'administrator' => redirect()->intended('/admin/dashboard'),
                'dokter' => redirect()->intended('/dokter/dashboard'),
                'pasien' => redirect()->intended('/pasien/dashboard'),
                default => redirect()->intended('/'),
            };
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
