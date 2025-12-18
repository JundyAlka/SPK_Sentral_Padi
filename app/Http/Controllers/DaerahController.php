<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\NilaiDaerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
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

    public function create()
    {
        return view('admin.daerah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);

        Daerah::create($request->all());

        return redirect()->route('admin.daerah.index')->with('success', 'Daerah berhasil ditambahkan.');
    }

    public function edit(Daerah $daerah)
    {
        return view('admin.daerah.edit', compact('daerah'));
    }

    public function update(Request $request, Daerah $daerah)
    {
        $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);

        $daerah->update($request->all());

        return redirect()->route('admin.daerah.index')->with('success', 'Daerah berhasil diperbarui.');
    }

    public function destroy(Daerah $daerah)
    {
        $daerah->delete();
        return redirect()->route('admin.daerah.index')->with('success', 'Daerah berhasil dihapus.');
    }

    public function nilai(Daerah $daerah)
    {
        $kriterias = Kriteria::all();
        $nilaiDaerah = NilaiDaerah::where('daerah_id', $daerah->id)->pluck('nilai', 'kriteria_id');
        return view('admin.daerah.nilai', compact('daerah', 'kriterias', 'nilaiDaerah'));
    }

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
