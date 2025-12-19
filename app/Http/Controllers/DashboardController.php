<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Daerah;
use App\Models\NilaiDaerah;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        $usersCount = User::count();
        $kriteriasCount = Kriteria::count();
        $daerahCount = Daerah::count();

        // Calculate Ranking (Reuse logic or call method)
        $perhitungan = new PerhitunganController();
        // Since hitungSAW is private, we can't call it directly unless we make it public or use reflection.
        // For now, let's replicate the basic logic lightly here OR change visibility. 
        // Changing visibility is cleaner.
        
        // I will implement a quick calculation here since we don't want to change PerhitunganController signature blindly.
        $kriterias = Kriteria::with('bobotDefault')->get();
        $daerahs = Daerah::with('nilaiDaerah')->get();
        
        // MinMax
        $minMax = [];
        foreach ($kriterias as $k) {
            $nilaiKriteria = NilaiDaerah::where('kriteria_id', $k->id)->pluck('nilai')->toArray();
             if (empty($nilaiKriteria)) {
                 $minMax[$k->id] = ['min' => 0, 'max' => 0];
            } else {
                $minMax[$k->id] = ['min' => min($nilaiKriteria), 'max' => max($nilaiKriteria)];
            }
        }

        $hasil = [];
        foreach ($daerahs as $d) {
            $skorTotal = 0;
            foreach ($kriterias as $k) {
                $nilai = $d->nilaiDaerah->where('kriteria_id', $k->id)->first()->nilai ?? 0;
                $bobot = $k->bobotDefault->bobot ?? 0;
                $normalisasi = 0;
                 if ($minMax[$k->id]['max'] > 0 && $minMax[$k->id]['min'] > 0) {
                     if ($k->jenis == 'benefit') {
                        $normalisasi = $nilai / $minMax[$k->id]['max'];
                    } else {
                        $normalisasi = ($nilai > 0) ? $minMax[$k->id]['min'] / $nilai : 0;
                    }
                }
                $skorTotal += $normalisasi * $bobot;
            }
            $hasil[] = [
                'nama_daerah' => $d->nama_daerah,
                'provinsi' => $d->provinsi,
                'skor_total' => $skorTotal
            ];
        }
        usort($hasil, function ($a, $b) { return $b['skor_total'] <=> $a['skor_total']; });
        
        // Add rank
        foreach($hasil as $i => &$h) { $h['rank'] = $i + 1; }

        return view('admin.dashboard', compact('usersCount', 'kriteriasCount', 'daerahCount', 'hasil'));
    }

    /**
     * Display the user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function indexUser()
    {
        // Reusing the calculation logic for User Dashboard
        $kriterias = Kriteria::with('bobotDefault')->get();
        $daerahs = Daerah::with('nilaiDaerah')->get();
        
        $minMax = [];
        foreach ($kriterias as $k) {
            $nilaiKriteria = NilaiDaerah::where('kriteria_id', $k->id)->pluck('nilai')->toArray();
             if (empty($nilaiKriteria)) {
                 $minMax[$k->id] = ['min' => 0, 'max' => 0];
            } else {
                $minMax[$k->id] = ['min' => min($nilaiKriteria), 'max' => max($nilaiKriteria)];
            }
        }

        $hasil = [];
        foreach ($daerahs as $d) {
            $skorTotal = 0;
            foreach ($kriterias as $k) {
                $nilaiObj = $d->nilaiDaerah->where('kriteria_id', $k->id)->first();
                $nilai = $nilaiObj ? $nilaiObj->nilai : 0;
                $bobot = $k->bobotDefault->bobot ?? 0;
                $normalisasi = 0;

                 if ($minMax[$k->id]['max'] > 0 && $minMax[$k->id]['min'] > 0) {
                     if ($k->jenis == 'benefit') {
                        $normalisasi = $nilai / $minMax[$k->id]['max'];
                    } else {
                        $normalisasi = ($nilai > 0) ? $minMax[$k->id]['min'] / $nilai : 0;
                    }
                }
                $skorTotal += $normalisasi * $bobot;
            }
            $hasil[] = [
                'nama_daerah' => $d->nama_daerah,
                'provinsi' => $d->provinsi,
                'skor_total' => $skorTotal
            ];
        }
        
        // Sort descending by score
        usort($hasil, function ($a, $b) { return $b['skor_total'] <=> $a['skor_total']; });
        
        // Add rank
        foreach($hasil as $i => &$h) { $h['rank'] = $i + 1; }

        return view('user.dashboard', compact('kriterias', 'hasil'));
    }
}
