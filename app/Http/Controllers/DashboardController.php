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
    /**
     * Menampilkan Dashboard Admin.
     * 
     * Fungsi ini:
     * 1. Menghitung ringkasan statistik (jumlah user, kriteria, daerah).
     * 2. Melakukan perhitungan SAW sederhana untuk menampilkan "Quick Ranking" di dashboard.
     * 3. Menyajikan data tersebut agar Admin bisa melihat overview sistem secara cepat.
     * 
     * @return \Illuminate\View\View Menampilkan view 'admin.dashboard'
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
        
        // ---------------------------------------------------------
        // TAHAP 1: Menentukan Nilai Min/Max untuk Setiap Kriteria
        // ---------------------------------------------------------
        // Kita perlu tahu nilai terendah (min) dan tertinggi (max) dari seluruh daerah
        // untuk setiap kriteria agar bisa melakukan normalisasi data.
        $minMax = [];
        foreach ($kriterias as $k) {
            // Ambil semua nilai dari database untuk kriteria 'k' ini
            $nilaiKriteria = NilaiDaerah::where('kriteria_id', $k->id)->pluck('nilai')->toArray();
            
            // Jika data kosong, set 0 untuk menghindari error
            if (empty($nilaiKriteria)) {
                 $minMax[$k->id] = ['min' => 0, 'max' => 0];
            } else {
                // Simpan nilai Min dan Max
                $minMax[$k->id] = ['min' => min($nilaiKriteria), 'max' => max($nilaiKriteria)];
            }
        }

        // ---------------------------------------------------------
        // TAHAP 2 & 3: Normalisasi dan Perangkingan
        // ---------------------------------------------------------
        $hasil = [];
        foreach ($daerahs as $d) {
            $skorTotal = 0;
            
            // Loop setiap kriteria untuk menghitung skor per kriteria
            foreach ($kriterias as $k) {
                // Ambil nilai asli daerah 'd' untuk kriteria 'k'
                $nilai = $d->nilaiDaerah->where('kriteria_id', $k->id)->first()->nilai ?? 0;
                
                // Ambil bobot kriteria (persentase kepentingan)
                $bobot = $k->bobotDefault->bobot ?? 0;
                
                $normalisasi = 0;
                
                // Cek agar tidak membagi dengan nol (division by zero prevention)
                if ($minMax[$k->id]['max'] > 0 && $minMax[$k->id]['min'] > 0) {
                     // RUMUS NORMALISASI SAW:
                     // Jika Benefit (Keuntungan): Nilai / Max
                     // Jika Cost (Biaya): Min / Nilai
                     if ($k->jenis == 'benefit') {
                        $normalisasi = $nilai / $minMax[$k->id]['max'];
                    } else {
                        $normalisasi = ($nilai > 0) ? $minMax[$k->id]['min'] / $nilai : 0;
                    }
                }
                
                // Akumulasikan skor: Hasil Normalisasi * Bobot
                $skorTotal += $normalisasi * $bobot;
            }
            
            // Simpan hasil akhir untuk pemeringkatan
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
    /**
     * Menampilkan Dashboard User (Pengguna Umum).
     * 
     * Fungsi ini:
     * 1. Menyiapkan data kriteria dan nilainya.
     * 2. Melakukan perhitungan SAW untuk menampilkan daftar peringkat daerah terbaik kepada user.
     * 3. Membantu user mendapatkan rekomendasi daerah secara langsung setelah login.
     * 
     * @return \Illuminate\View\View Menampilkan view 'user.dashboard'
     */
    public function indexUser()
    {
        // ---------------------------------------------------------
        // PERSIAPAN DATA (FETCHING)
        // ---------------------------------------------------------
        // Mengambil data Kriteria beserta bobotnya (Eager Loading)
        $kriterias = Kriteria::with('bobotDefault')->get();
        // Mengambil data Daerah beserta nilai-nilai kriterianya
        $daerahs = Daerah::with('nilaiDaerah')->get();
        
        // ---------------------------------------------------------
        // TAHAP 1: Menentukan Nilai Min/Max (Normalisasi)
        // ---------------------------------------------------------
        $minMax = [];
        foreach ($kriterias as $k) {
            // Ambil array nilai untuk kriteria tertentu dari seluruh daerah
            $nilaiKriteria = NilaiDaerah::where('kriteria_id', $k->id)->pluck('nilai')->toArray();
            
            // Simpan nilai Minimum dan Maksimum untuk rumus SAW
            if (empty($nilaiKriteria)) {
                 $minMax[$k->id] = ['min' => 0, 'max' => 0];
            } else {
                $minMax[$k->id] = ['min' => min($nilaiKriteria), 'max' => max($nilaiKriteria)];
            }
        }

        // ---------------------------------------------------------
        // TAHAP 2 & 3: Perhitungan Skor (Normalisasi & Preferensi)
        // ---------------------------------------------------------
        $hasil = [];
        foreach ($daerahs as $d) {
            $skorTotal = 0;
            
            foreach ($kriterias as $k) {
                // Ambil nilai daerah untuk kriteria ini
                $nilaiObj = $d->nilaiDaerah->where('kriteria_id', $k->id)->first();
                $nilai = $nilaiObj ? $nilaiObj->nilai : 0;
                
                $bobot = $k->bobotDefault->bobot ?? 0;
                $normalisasi = 0;

                // Hitung Normalisasi Matriks (R)
                if ($minMax[$k->id]['max'] > 0 && $minMax[$k->id]['min'] > 0) {
                     if ($k->jenis == 'benefit') {
                        // Benefit: Nilai dibagi Max
                        $normalisasi = $nilai / $minMax[$k->id]['max'];
                    } else {
                        // Cost: Min dibagi Nilai
                        $normalisasi = ($nilai > 0) ? $minMax[$k->id]['min'] / $nilai : 0;
                    }
                }
                
                // Hitung Skor (V) = Normalisasi * Bobot
                $skorTotal += $normalisasi * $bobot;
            }
            
            // Masukkan ke array hasil sementara
            $hasil[] = [
                'nama_daerah' => $d->nama_daerah,
                'provinsi' => $d->provinsi,
                'skor_total' => $skorTotal
            ];
        }
        
        // ---------------------------------------------------------
        // TAHAP 4: Perankingan (Sorting Descending)
        // ---------------------------------------------------------
        usort($hasil, function ($a, $b) { return $b['skor_total'] <=> $a['skor_total']; });
        
        // Tambahkan nomor ranking (juara 1, 2, 3...)
        foreach($hasil as $i => &$h) { $h['rank'] = $i + 1; }

        // Kirim data ke view User Dashboard
        return view('user.dashboard', compact('kriterias', 'hasil'));
    }
}
