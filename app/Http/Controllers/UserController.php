<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    // Menampilkan form tambah pengguna baru
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Menyimpan Data Pengguna Baru (Create).
     * 
     * 1. Validasi: Memastikan semua field terisi benar dan email belum dipakai.
     * 2. Hash::make: Password DIWAJIBKAN di-hash/enkripsi agar tidak bisa dibaca manusia.
     * 3. Simpan ke database.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan form edit data pengguna
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Memperbarui Data Pengguna (Update).
     * 
     * 1. Validasi Unik Email: Menggunakan `Rule::unique(...)->ignore(...)`.
     *    Artinya: Cek email unik, TAPI abaikan (anggap valid) jika itu email milik user itu sendiri.
     *    Ini penting agar saat user update nama tapi email sama, tidak dianggap error "Email sudah terdaftar".
     * 2. Cek Password: Jika field password kosong, berarti password tidak diubah.
     *    Jika diisi, maka hash ulang password baru.
     * 
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus data pengguna dari database
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }
        
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }
}
