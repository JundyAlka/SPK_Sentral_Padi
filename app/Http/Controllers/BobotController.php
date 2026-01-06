<?php

namespace App\Http\Controllers;

use App\Models\BobotDefault;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BobotController extends Controller
{
    // Menampilkan halaman pengaturan bobot kriteria
    public function index()
    {
        try {
            // Menggunakan Eager Loading 'with()' untuk mengambil relasi bobotDefault sekaligus.
            // Ini mencegah N+1 Query Problem (terlalu banyak query ke database).
            $kriterias = Kriteria::with('bobotDefault')->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error (misalnya tabel belum ada karena belum migrasi),
            // kita sediakan data koleksi manual (hardcode) agar halaman tidak error (White Screen).
            $kriterias = collect([
                (object)[ 'id' => 1, 'nama_kriteria' => 'Luas Panen (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.35] ],
                (object)[ 'id' => 2, 'nama_kriteria' => 'Produktivitas (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.25] ],
                (object)[ 'id' => 3, 'nama_kriteria' => 'Curah Hujan (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
                (object)[ 'id' => 4, 'nama_kriteria' => 'Hama (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
            ]);
        }
        return view('admin.bobot.index', compact('kriterias'));
    }

    /**
     * Menyimpan Perubahan Total Bobot.
     * 
     * Fungsi ini memvalidasi agar Total Bobot dari seluruh kriteria harus bernilai 1 (atau 100%).
     * 1. array_sum: Menjumlahkan seluruh input bobot.
     * 2. Validasi Toleransi: Karena komputasi desimal, kita pakai toleransi 0.001.
     *    Jika |Total - 1| > 0.001, berarti tidak valid (bukan 100%).
     * 3. Loop Save: Jika valid, simpan bobot untuk setiap kriteria.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validasi input array 'bobot'
        $request->validate([
            'bobot' => 'required|array', // Pastikan input bernama 'bobot' ada dan berbentuk array
            'bobot.*' => 'required|numeric|min:0|max:1', // Setiap item dalam array harus angka 0-1
        ]);

        // Menghitung total semua bobot yang diinputkan
        $totalBobot = array_sum($request->bobot);

        // Validasi Logika: Total bobot harus 1.0 (100%)
        // Menggunakan abs() dan toleransi 0.001 karena operasi floating point komputer tidak selalu presisi.
        if (abs($totalBobot - 1) > 0.001) {
            // Jika tidak 1, kembalikan ke halaman sebelumnya dengan pesan error khusus.
            return back()->withErrors(['total' => 'Total bobot harus sama dengan 1. Total saat ini: ' . $totalBobot]);
        }

        // Loop setiap input bobot berdasarkan ID Kriteria
        foreach ($request->bobot as $kriteriaId => $nilaiBobot) {
            // Fungsi updateOrCreate:
            // 1. Cari data di tabel 'bobot_defaults' dengan 'kriteria_id' tertentu.
            // 2. Jika ketemu -> UPDATE data tersebut.
            // 3. Jika tidak ketemu -> CREATE data baru.
            BobotDefault::updateOrCreate(
                ['kriteria_id' => $kriteriaId], // Kondisi pencarian
                [
                    'bobot' => $nilaiBobot,      // Data yang diupdate/simpan
                    'updated_by' => Auth::id(),  // Simpan ID user yang melakukan update (untuk audit trail)
                    'updated_at' => now(),       // Timestamp waktu update
                ]
            );
        }

        return redirect()->route('admin.bobot.index')->with('success', 'Bobot berhasil diperbarui.');
    }
}
