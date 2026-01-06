<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan Halaman Login.
     * 
     * Mengarahkan pengguna ke view 'auth.login' di mana terdapat form
     * untuk memasukkan email dan password.
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses Otentikasi (Login).
     * 
     * Tahapan:
     * 1. Validasi input: Memastikan email dan password tidak kosong & format email benar.
     * 2. Auth::attempt: Mencocokkan kredensial dengan database.
     *    - Jika cocok: Regenerasi session ID (keamanan) dan redirect sesuai Role.
     *    - Jika gagal: Kembali ke form login dengan pesan error.
     * 3. Pengecekan Role (Admin/User) untuk menentukan tujuan redirect.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba melakukan login dengan kredensial yang diberikan
        // Auth::attempt akan otomatis menghash password input dan mencocokkannya dengan hash di database.
        if (Auth::attempt($credentials)) {
            // Regenerasi Session ID untuk mencegah serangan Session Fixation
            $request->session()->regenerate();
            
            // Cek Role User untuk menentukan halaman tujuan redirect
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Admin ke Dashboard Admin
            }

            return redirect()->route('user.dashboard'); // User biasa ke Dashboard User
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Memproses Logout (Keluar).
     * 
     * 1. Menghapus sesi otentikasi user saat ini.
     * 2. Invalidate session: Menghapus data sesi server demi keamanan.
     * 3. Regenerate Token: Mencegah serangan CSRF (Cross-Site Request Forgery).
     * 4. Redirect pengguna kembali ke halaman login.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
