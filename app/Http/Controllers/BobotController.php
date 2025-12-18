<?php

namespace App\Http\Controllers;

use App\Models\BobotDefault;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BobotController extends Controller
{
    public function index()
    {
        try {
            $kriterias = Kriteria::with('bobotDefault')->get();
        } catch (\Illuminate\Database\QueryException $e) {
            $kriterias = collect([
                (object)[ 'id' => 1, 'nama_kriteria' => 'Luas Panen (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.35] ],
                (object)[ 'id' => 2, 'nama_kriteria' => 'Produktivitas (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.25] ],
                (object)[ 'id' => 3, 'nama_kriteria' => 'Curah Hujan (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
                (object)[ 'id' => 4, 'nama_kriteria' => 'Hama (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
            ]);
        }
        return view('admin.bobot.index', compact('kriterias'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bobot' => 'required|array',
            'bobot.*' => 'required|numeric|min:0|max:1',
        ]);

        $totalBobot = array_sum($request->bobot);

        if (abs($totalBobot - 1) > 0.001) {
            return back()->withErrors(['total' => 'Total bobot harus sama dengan 1. Total saat ini: ' . $totalBobot]);
        }

        foreach ($request->bobot as $kriteriaId => $nilaiBobot) {
            BobotDefault::updateOrCreate(
                ['kriteria_id' => $kriteriaId],
                [
                    'bobot' => $nilaiBobot,
                    'updated_by' => Auth::id(),
                    'updated_at' => now(),
                ]
            );
        }

        return redirect()->route('admin.bobot.index')->with('success', 'Bobot berhasil diperbarui.');
    }
}
