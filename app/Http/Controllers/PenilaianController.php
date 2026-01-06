<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\NilaiDaerah;

class PenilaianController extends Controller
{
    /**
     * Menampilkan halaman Manajemen Penilaian.
     * 
     * Halaman ini menampilkan daftar seluruh daerah beserta status/nilai yang telah diinputkan.
     * Admin dapat memilih daerah mana yang ingin diedit nilainya dari sini.
     * 
     * @return \Illuminate\View\View Menampilkan view 'admin.penilaian.index'
     */
    public function index()
    {
        $daerahs = Daerah::with('nilaiDaerah')->get();
        $kriterias = Kriteria::orderBy('id')->get();
        return view('admin.penilaian.index', compact('daerahs', 'kriterias'));
    }

    /**
     * Menampilkan Form Edit Nilai untuk Sebuah Daerah.
     * 
     * Mengambil data daerah dan nilai-nilai kriteria yang sudah ada (jika ada).
     * Mengirimkan data tersebut ke view agar Admin bisa mengubah skor/nilai kriteria daerah tersebut.
     * 
     * @param int $id ID dari daerah yang akan diedit
     * @return \Illuminate\View\View Menampilkan view 'admin.penilaian.edit'
     */
    public function edit($id)
    {
        $daerah = Daerah::findOrFail($id);
        $kriterias = Kriteria::all();
        $nilaiDaerah = NilaiDaerah::where('daerah_id', $id)->pluck('nilai', 'kriteria_id')->toArray();
        
        return view('admin.penilaian.edit', compact('daerah', 'kriterias', 'nilaiDaerah'));
    }

    /**
     * Menyimpan Perubahan Nilai Kriteria ke Database.
     * 
     * Melakukan iterasi pada setiap input nilai kriteria dan menyimpannya ke tabel `nilai_daerah`.
     * Menggunakan `updateOrCreate` agar jika data belum ada akan dibuat, jika sudah ada akan diupdate.
     * 
     * @param Request $request Data input nilai dari form
     * @param int $id ID Daerah yang dinilai
     * @return \Illuminate\Http\RedirectResponse Redirect kembali ke index dengan pesan sukses
     */
    public function update(Request $request, $id)
    {
        // Mencari data Daerah berdasarkan ID, jika tidak ketemu akan otomatis return 404 (Not Found).
        $daerah = Daerah::findOrFail($id);
        
        // ---------------------------------------------------------
        // VALIDASI DINAMIS
        // ---------------------------------------------------------
        // Kita tidak tahu berapa banyak kriteria yang ada di database.
        // Jadi kita loop input 'nilai' untuk membuat rules validasi secara dinamis.
        $rules = [];
        foreach ($request->nilai as $kriteriaId => $nilai) {
            // Membuat rule: "nilai.1", "nilai.2", dst harus required dan numeric.
            $rules["nilai.$kriteriaId"] = 'required|numeric';
        }
        // Jalankan validasi dengan rules yang sudah dibuat
        $request->validate($rules);

        // ---------------------------------------------------------
        // SIMPAN NILAI KE DATABASE
        // ---------------------------------------------------------
        foreach ($request->nilai as $kriteriaId => $nilai) {
            // Simpan setiap nilai kriteria untuk daerah ini secara terpisah.
            // Gunakan updateOrCreate agar tidak terjadi duplikasi data untuk kriteria yang sama pada daerah yang sama.
            NilaiDaerah::updateOrCreate(
                [
                    'daerah_id' => $daerah->id,      // Kunci 1: ID Daerah
                    'kriteria_id' => $kriteriaId     // Kunci 2: ID Kriteria
                ],
                [
                    'nilai' => $nilai                // Nilai yang diupdate/disimpan
                ]
            );
        }

        return redirect()->route('admin.penilaian.index')->with('success', 'Data penilaian berhasil diperbarui.');
    }
}
