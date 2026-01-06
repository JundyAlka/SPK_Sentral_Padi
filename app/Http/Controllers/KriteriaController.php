<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // Menampilkan daftar data kriteria
    public function index()
    {
        try {
            $kriterias = Kriteria::with('bobotDefault')->get();
        } catch (\Illuminate\Database\QueryException $e) {
            $kriterias = collect([]);
        }
        return view('admin.kriteria.index', compact('kriterias'));
    }

    // Menampilkan form tambah kriteria baru
    public function create()
    {
        return view('admin.kriteria.create');
    }

    /**
     * Menyimpan Kriteria Baru.
     * 
     * 1. Validasi: Kode kriteria harus unik (tidak boleh ada C1 ganda).
     * 2. Jenis Kriteria: Harus dipilih antara 'benefit' (Keuntungan) atau 'cost' (Biaya).
     *    - Benefit: Semakin besar semakin bagus.
     *    - Cost: Semakin kecil semakin bagus.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:20|unique:kriterias,kode_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'jenis' => 'required|in:benefit,cost',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    // Menampilkan form edit data kriteria
    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    /**
     * Memperbarui Data Kriteria.
     * 
     * Selain mengupdate nama dan jenis, fungsi ini juga mengupdate Bobot Default.
     * Input bobot dari user biasanya dalam persen (0-100), jadi perlu dibagi 100
     * sebelum disimpan ke database (0.0 - 1.0).
     * 
     * @param Request $request
     * @param Kriteria $kriteria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:20|unique:kriterias,kode_kriteria,'.$kriteria->id,
            'nama_kriteria' => 'required|string|max:255',
            'jenis' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:100',
        ]);

        $kriteria->update([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'jenis' => $request->jenis,
        ]);

        // Update atau Buat Bobot Default
        // Konversi Persentase ke Desimal:
        // Input user misal '25' (artinya 25%), kita simpan sebagai 0.25 agar mudah dikali saat perhitungan.
        $bobotDecimal = $request->bobot / 100;
        
        \App\Models\BobotDefault::updateOrCreate(
            ['kriteria_id' => $kriteria->id], // Cari bobot milik kriteria ini
            [
                'bobot' => $bobotDecimal,     // Simpan nilai desimal (0.xx)
                'updated_by' => auth()->id() ?? null 
            ]
        );

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria dan bobot berhasil diperbarui.');
    }

    /**
     * Menghapus Kriteria.
     * 
     * PENTING: Sebelum menghapus, sistem mengecek dulu apakah kriteria ini
     * sudah digunakan dalam penilaian (tabel nilai_daerah).
     * Jika SUDAH dipakai, maka penghapusan DITOLAK agar tidak merusak data penilaian yang ada.
     * 
     * @param Kriteria $kriteria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Kriteria $kriteria)
    {
        // CEK KETERGANTUNGAN DATA (Foreign Key Check)
        // Sebelum menghapus kriteria, cek apakah kriteria ini sudah pernah dipakai untuk menilai daerah?
        if (\App\Models\NilaiDaerah::where('kriteria_id', $kriteria->id)->exists()) {
            // Jika ADA, batalkan penghapusan dan beri peringatan.
            // Menghapus kriteria yang sudah ada nilainya akan menyebabkan data penilaian daerah menjadi korup/hilang.
            return redirect()->route('admin.kriteria.index')->with('error', 'Gagal menghapus! Kriteria ini sudah digunakan dalam data penilaian.');
        }

        $kriteria->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
