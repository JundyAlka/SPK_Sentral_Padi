<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan form registrasi pengguna baru
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Memproses Pendaftaran Akun Baru.
     * 
     * Tahapan:
     * 1. Validasi Input:
     *    - Nama: Wajib diisi.
     *    - Email: Wajib, format email, dan HARUS UNIK (belum terdaftar).
     *    - Password: Minimal 8 karakter, dan harus dikonfirmasi (ketik ulang).
     * 2. Hash Password: Password dienkripsi menggunakan Bcrypt sebelum disimpan demi keamanan.
     * 3. Create User: Menyimpan data ke tabel users dengan role default 'user'.
     * 4. Auto Login: Pengguna langsung login setelah daftar (UX improvement).
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create User Baru
        // Menggunakan Mass Assignment untuk menyimpan data ke database.
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Hash Password: Mengubah password text biasa menjadi hash terenkripsi (Bcrypt).
            // Ini WAJIB dilakukan agar password tidak terbaca jika database bocor.
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role adalah 'user'. Admin harus di-set manual via database/admin panel.
        ]);

        // Auto-login: Langsung login-kan user yang baru mendaftar
        // Memberikan pengalaman pengguna (UX) yang lebih mulus tanpa perlu login ulang.
        Auth::login($user);

        return redirect()->route('user.dashboard');
    }
}
