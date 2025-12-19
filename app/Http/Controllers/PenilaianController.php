<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\NilaiDaerah;

class PenilaianController extends Controller
{
    public function index()
    {
        $daerahs = Daerah::with('nilaiDaerah')->get();
        $kriterias = Kriteria::orderBy('id')->get();
        return view('admin.penilaian.index', compact('daerahs', 'kriterias'));
    }

    public function edit($id)
    {
        $daerah = Daerah::findOrFail($id);
        $kriterias = Kriteria::all();
        $nilaiDaerah = NilaiDaerah::where('daerah_id', $id)->pluck('nilai', 'kriteria_id')->toArray();
        
        return view('admin.penilaian.edit', compact('daerah', 'kriterias', 'nilaiDaerah'));
    }

    public function update(Request $request, $id)
    {
        $daerah = Daerah::findOrFail($id);
        
        // Validate inputs dynamically
        $rules = [];
        foreach ($request->nilai as $kriteriaId => $nilai) {
            $rules["nilai.$kriteriaId"] = 'required|numeric';
        }
        $request->validate($rules);

        foreach ($request->nilai as $kriteriaId => $nilai) {
            NilaiDaerah::updateOrCreate(
                ['daerah_id' => $daerah->id, 'kriteria_id' => $kriteriaId],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('admin.penilaian.index')->with('success', 'Data penilaian berhasil diperbarui.');
    }
}
