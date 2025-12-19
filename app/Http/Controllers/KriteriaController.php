<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        try {
            $kriterias = Kriteria::with('bobotDefault')->get();
        } catch (\Illuminate\Database\QueryException $e) {
            $kriterias = collect([]);
        }
        return view('admin.kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

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

    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

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

        // Update or Create Bobot
        // Convert percentage (e.g. 25) to decimal (0.25)
        $bobotDecimal = $request->bobot / 100;

        \App\Models\BobotDefault::updateOrCreate(
            ['kriteria_id' => $kriteria->id],
            [
                'bobot' => $bobotDecimal,
                'updated_by' => auth()->id() ?? null 
            ]
        );

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria dan bobot berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        // Check if Kriteria is used in NilaiDaerah
        if (\App\Models\NilaiDaerah::where('kriteria_id', $kriteria->id)->exists()) {
            return redirect()->route('admin.kriteria.index')->with('error', 'Gagal menghapus! Kriteria ini sudah digunakan dalam data penilaian.');
        }

        $kriteria->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
