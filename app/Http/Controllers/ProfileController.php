<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil pengguna yang sedang login
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Memperbarui Profil Saya (Self-Update).
     * 
     * Logika hampir sama dengan UserController, namun hanya berlaku untuk user yang sedang login.
     * User tidak bisa mengubah Role-nya sendiri di sini demi keamanan.
     * Password hanya diupdate jika input password diisi.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        /** @var \App\Models\User $user */
        $user->update($data);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile berhasil diperbarui.');
    }
}
