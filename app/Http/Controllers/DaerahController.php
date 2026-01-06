<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\NilaiDaerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    /**
     * Menampilkan Daftar Daerah.
     * 
     * Mengambil semua data daerah dari database untuk ditampilkan dalam tabel.
     * Jika terjadi error koneksi database, akan menampilkan data contoh (fallback).
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $daerahs = Daerah::all();
        } catch (\Illuminate\Database\QueryException $e) {
            $daerahs = collect([
                (object)['id' => 101, 'nama_daerah' => 'Karawang (Contoh)', 'provinsi' => 'Jawa Barat'],
                (object)['id' => 102, 'nama_daerah' => 'Indramayu (Contoh)', 'provinsi' => 'Jawa Barat'],
                (object)['id' => 103, 'nama_daerah' => 'Ngawi (Contoh)', 'provinsi' => 'Jawa Timur'],
            ]);
        }
        return view('admin.daerah.index', compact('daerahs'));
    }

    // Menampilkan form tambah daerah baru
    public function create()
    {
        return view('admin.daerah.create');
    }

    /**
     * Menyimpan Data Daerah Baru (Create).
     * 
     * 1. Validasi: Nama daerah dan provinsi harus diisi (wajib) dan maksimal 255 karakter.
     * 2. Simpan: Menggunakan method create() yang otomatis memetakan input ke kolom database.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);

        Daerah::create($request->all());

        return redirect()->route('admin.daerah.index')->with('success', 'Daerah berhasil ditambahkan.');
    }

    // Menampilkan form edit data daerah
    public function edit(Daerah $daerah)
    {
        return view('admin.daerah.edit', compact('daerah'));
    }

    // Memperbarui data daerah yang sudah ada
    public function update(Request $request, Daerah $daerah)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);

        $daerah->update($request->all());

        return redirect()->route('admin.daerah.index')->with('success', 'Daerah berhasil diperbarui.');
    }

    // Menghapus data daerah dari database
    public function destroy(Daerah $daerah)
    {
        $daerah->delete();
        return redirect()->route('admin.daerah.index')->with('success', 'Daerah berhasil dihapus.');
    }

    // Menampilkan halaman input nilai kriteria untuk daerah tertentu
    public function nilai(Daerah $daerah)
    {
        $kriterias = Kriteria::all();
        $nilaiDaerah = NilaiDaerah::where('daerah_id', $daerah->id)->pluck('nilai', 'kriteria_id');
        return view('admin.daerah.nilai', compact('daerah', 'kriterias', 'nilaiDaerah'));
    }

    /**
     * Menyimpan Input Nilai Kriteria untuk Sebuah Daerah.
     * 
     * Fungsi ini menerima array input nilai (misal: nilai panen, produktivitas, dll).
     * Melakukan loop untuk menyimpan setiap nilai ke tabel `nilai_daerah` 
     * menggunakan pasangan (daerah_id, kriteria_id).
     * 
     * @param Request $request
     * @param Daerah $daerah
     * @return \Illuminate\Http\RedirectResponse
     */
    public function nilaiStoreOrUpdate(Request $request, Daerah $daerah)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric',
        ]);

        foreach ($request->nilai as $kriteriaId => $nilai) {
            NilaiDaerah::updateOrCreate(
                ['daerah_id' => $daerah->id, 'kriteria_id' => $kriteriaId],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('admin.daerah.index')->with('success', 'Nilai daerah berhasil diperbarui.');
    }
}
