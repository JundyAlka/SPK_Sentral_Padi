<?php

namespace App\Http\Controllers;

use App\Models\BobotDefault;
use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\LogPerhitungan;
use App\Models\NilaiDaerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class PerhitunganController extends Controller
{
    public function index()
    {
        try {
            $kriterias = Kriteria::with('bobotDefault')->get();
        } catch (QueryException $e) {
            $kriterias = $this->getMockKriterias();
        }
        return view('user.analisis.index', compact('kriterias'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'nama_daerah_input' => 'required|string|max:255',
        ]);

        $namaDaerahInput = $request->nama_daerah_input;
        
        $data = $this->hitungSAW($namaDaerahInput);

        // Extract result
        $hasil = $data['hasil'];
        $kriterias = $data['kriterias'];
        
        // Log Perhitungan (Try-Catch safe)
        if (Auth::check() && Auth::user()->role === 'user') {
            try {
                LogPerhitungan::create([
                    'user_id' => Auth::id(),
                    'executed_at' => now(),
                    'keterangan' => "Analisis: $namaDaerahInput",
                ]);
            } catch (QueryException $e) {
                // Ignore log failure in Demo/Mock mode
            }
        }
       
        $top5 = array_slice($hasil, 0, 5);

        return view('user.analisis.hasil', compact('hasil', 'top5', 'namaDaerahInput', 'kriterias'));
    }

    public function detail($daerah_id)
    {
        $data = $this->hitungSAW();
        $detailDaerah = collect($data['hasil'])->firstWhere('daerah_id', $daerah_id);
        $kriterias = $data['kriterias'];
        
        if (!$detailDaerah) {
            // Fallback if ID not found (e.g. from mock data URL manipulation)
            return redirect()->route('user.analisis.index')->with('error', 'Data tidak ditemukan');
        }

        return view('user.analisis.detail', compact('detailDaerah', 'kriterias'));
    }

    // Admin: Data Perhitungan
    public function dataPerhitungan()
    {
        $data = $this->hitungSAW();
        return view('admin.perhitungan.index', [
            'kriterias' => $data['kriterias'],
            'hasil' => $data['hasil']
        ]);
    }

    // Admin: Data Hasil Akhir
    public function dataHasilAkhir()
    {
        $data = $this->hitungSAW();
        $hasil = $data['hasil']; // Already sorted and ranked in hitungSAW
        return view('admin.hasil.index', compact('hasil'));
    }

    private function hitungSAW($namaDaerahInput = '') {
        try {
            // Attempt to get Real Data
            $kriterias = Kriteria::with('bobotDefault')->get();
            $daerahs = Daerah::with('nilaiDaerah')->get();
            
            // Check if tables are empty, trigger fallback if so
            if ($kriterias->isEmpty() || $daerahs->isEmpty()) throw new \Exception("Empty Data");

        } catch (\Exception $e) {
            // Use Mock Data
            $kriterias = $this->getMockKriterias();
            $daerahs = $this->getMockDaerahs();
        }

        $minMax = [];
        // Pre-calculate Min/Max (Works for both Real and Mock objects if structured consistently)
        foreach ($kriterias as $k) {
            // Check if using Mock Object or Eloquent Model
            $isMock = !($k instanceof Kriteria);
            $kId = $k->id;

            if ($isMock) {
                 // Manual collection for mock
                 $nilaiValues = [];
                 foreach ($daerahs as $d) {
                     $val = collect($d->nilaiDaerah)->where('kriteria_id', $kId)->first();
                     $nilaiValues[] = $val ? $val->nilai : 0;
                 }
            } else {
                $nilaiValues = NilaiDaerah::where('kriteria_id', $kId)->pluck('nilai')->toArray();
            }

            if (empty($nilaiValues)) {
                 $minMax[$kId] = ['min' => 0, 'max' => 0];
            } else {
                $minMax[$kId] = [
                    'min' => min($nilaiValues),
                    'max' => max($nilaiValues),
                ];
            }
        }

        $hasil = [];
        foreach ($daerahs as $d) {
            $skorTotal = 0;
            $detailNilai = [];

            foreach ($kriterias as $k) {
                // Compatible access for both Mock (array/obj) and Eloquent
                $nilaiObj = is_array($d->nilaiDaerah) 
                    ? collect($d->nilaiDaerah)->where('kriteria_id', $k->id)->first()
                    : $d->nilaiDaerah->where('kriteria_id', $k->id)->first();
                
                $nilai = $nilaiObj->nilai ?? 0;
                $bobotObj = $k->bobotDefault; // Works for both if mock structure matches
                $bobot = $bobotObj->bobot ?? 0;
                
                $normalisasi = 0;
                $min = $minMax[$k->id]['min'];
                $max = $minMax[$k->id]['max'];

                if ($max > 0) { // Basic safety
                     if ($k->jenis == 'benefit') {
                        $normalisasi = $nilai / $max;
                    } else {
                        $normalisasi = ($nilai > 0) ? $min / $nilai : 0;
                    }
                }

                $skor = $normalisasi * $bobot;
                $skorTotal += $skor;

                $detailNilai[$k->id] = [
                    'nilai_asli' => $nilai,
                    'normalisasi' => $normalisasi,
                    'bobot' => $bobot,
                    'skor' => $skor
                ];
            }

            $hasil[] = [
                'daerah_id' => $d->id,
                'nama_daerah' => $d->nama_daerah,
                'provinsi' => $d->provinsi,
                'skor_total' => $skorTotal,
                'detail' => $detailNilai
            ];
        }

        usort($hasil, function ($a, $b) {
            return $b['skor_total'] <=> $a['skor_total'];
        });

        foreach ($hasil as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        return ['hasil' => $hasil, 'kriterias' => $kriterias];
    }
    
    private function getMockKriterias() {
        return collect([
            (object)[ 'id' => 1, 'nama_kriteria' => 'Luas Panen (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.35] ],
            (object)[ 'id' => 2, 'nama_kriteria' => 'Produktivitas (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.25] ],
            (object)[ 'id' => 3, 'nama_kriteria' => 'Curah Hujan (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
            (object)[ 'id' => 4, 'nama_kriteria' => 'Hama (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
        ]);
    }

    private function getMockDaerahs() {
        return collect([
            (object)[ 
                'id' => 101, 
                'nama_daerah' => 'Karawang (Contoh)', 
                'provinsi' => 'Jawa Barat',
                'nilaiDaerah' => [
                    (object)['kriteria_id' => 1, 'nilai' => 8000],
                    (object)['kriteria_id' => 2, 'nilai' => 75],
                    (object)['kriteria_id' => 3, 'nilai' => 200], // Curah hujan high cost
                    (object)['kriteria_id' => 4, 'nilai' => 10] // Hama low
                ]
            ],
            (object)[ 
                'id' => 102, 
                'nama_daerah' => 'Indramayu (Contoh)', 
                'provinsi' => 'Jawa Barat',
                'nilaiDaerah' => [
                    (object)['kriteria_id' => 1, 'nilai' => 9000],
                    (object)['kriteria_id' => 2, 'nilai' => 70],
                    (object)['kriteria_id' => 3, 'nilai' => 150], 
                    (object)['kriteria_id' => 4, 'nilai' => 20]
                ]
            ],
            (object)[ 
                'id' => 103, 
                'nama_daerah' => 'Ngawi (Contoh)', 
                'provinsi' => 'Jawa Timur',
                'nilaiDaerah' => [
                    (object)['kriteria_id' => 1, 'nilai' => 7500],
                    (object)['kriteria_id' => 2, 'nilai' => 85], // High Prod
                    (object)['kriteria_id' => 3, 'nilai' => 120], 
                    (object)['kriteria_id' => 4, 'nilai' => 15]
                ]
            ],
        ]);
    }
}
