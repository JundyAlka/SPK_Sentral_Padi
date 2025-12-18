<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        try {
            $kriterias = Kriteria::all();
        } catch (\Illuminate\Database\QueryException $e) {
            $kriterias = collect([
                (object)[ 'id' => 1, 'nama_kriteria' => 'Luas Panen (Contoh)', 'jenis' => 'benefit'],
                (object)[ 'id' => 2, 'nama_kriteria' => 'Produktivitas (Contoh)', 'jenis' => 'benefit'],
                (object)[ 'id' => 3, 'nama_kriteria' => 'Curah Hujan (Contoh)', 'jenis' => 'cost'],
                (object)[ 'id' => 4, 'nama_kriteria' => 'Hama (Contoh)', 'jenis' => 'cost'],
            ]);
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
            'nama_kriteria' => 'required|string|max:255',
            'jenis' => 'required|in:benefit,cost',
        ]);

        $kriteria->update($request->all());

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
