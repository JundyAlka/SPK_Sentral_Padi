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
    /**
     * Menampilkan halaman awal fitur analisis untuk pengguna umum (User).
     * 
     * Fungsi ini mengambil data kriteria beserta bobot default-nya dari database
     * untuk ditampilkan di form analisis, sehingga user tahu kriteria apa saja yang dinilai.
     * Jika terjadi kesalahan database, akan menggunakan mock data (data dummy).
     * 
     * @return \Illuminate\View\View Menampilkan view 'user.analisis.index'
     */
    public function index()
    {
        try {
            $kriterias = Kriteria::with('bobotDefault')->get();
        } catch (QueryException $e) {
            $kriterias = $this->getMockKriterias();
        }
        return view('user.analisis.index', compact('kriterias'));
    }

    /**
     * Memproses perhitungan Sistem Pendukung Keputusan (SPK) metode SAW.
     * 
     * Langkah-langkah:
     * 1. Validasi input nama daerah dari form.
     * 2. Memanggil fungsi private `hitungSAW()` untuk melakukan kalkulasi matematis.
     * 3. Menyimpan log riwayat perhitungan ke database jika user sedang login.
     * 4. Mengambil 5 daerah terbaik (Top 5) untuk ditampilkan sebagai rekomendasi.
     * 
     * @param Request $request Data input dari form
     * @return \Illuminate\View\View Menampilkan hasil di 'user.analisis.hasil'
     */
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

    /**
     * Menampilkan detail nilai perhitungan untuk satu daerah tertentu.
     * 
     * Fungsi ini berguna untuk transparansi, agar user bisa melihat detail:
     * - Nilai asli (raw value)
     * - Nilai hasil normalisasi
     * - Nilai akhir setelah dikali bobot
     * 
     * @param int $daerah_id ID Daerah yang ingin dilihat detailnya
     * @return \Illuminate\View\View Menampilkan view 'user.analisis.detail'
     */
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

    /**
     * [ADMIN] Menampilkan seluruh data perhitungan secara lengkap.
     * 
     * Digunakan oleh Admin untuk memverifikasi kebenaran sistem.
     * Menampilkan matriks keputusan awal, hasil normalisasi, dan hasil akhir.
     * 
     * @return \Illuminate\View\View Menampilkan view 'admin.perhitungan.index'
     */
    public function dataPerhitungan()
    {
        $data = $this->hitungSAW();
        return view('admin.perhitungan.index', [
            'kriterias' => $data['kriterias'],
            'hasil' => $data['hasil']
        ]);
    }

    /**
     * [ADMIN] Menampilkan daftar hasil akhir perankingan.
     * 
     * Menampilkan daftar daerah yang sudah diurutkan dari nilai tertinggi ke terendah.
     * Ini adalah output utama dari sistem SPK untuk pengambilan keputusan.
     * 
     * @return \Illuminate\View\View Menampilkan view 'admin.hasil.index'
     */
    public function dataHasilAkhir()
    {
        $data = $this->hitungSAW();
        $hasil = $data['hasil']; // Already sorted and ranked in hitungSAW
        return view('admin.hasil.index', compact('hasil'));
    }

    /**
     * [CORE LOGIC] Fungsi Inti Perhitungan Metode SAW (Simple Additive Weighting).
     * 
     * Algoritma SAW:
     * 1. Ambil data kriteria, bobot, dan nilai semua daerah.
     * 2. Cari nilai Min/Max tiap kriteria untuk rumus normalisasi.
     * 3. Lakukan Normalisasi Matriks (R):
     *    - Jika Benefit: Nilai / Max
     *    - Jika Cost: Min / Nilai
     * 4. Hitung Nilai Preferensi (V):
     *    - Sigma (Nilai Normalisasi * Bobot Kriteria)
     * 5. Urutkan hasil dari nilai terbesar ke terkecil (Ranking).
     * 
     * @param string $namaDaerahInput (Opsional) Untuk keperluan simulasi nama
     * @return array Mengembalikan array berisi 'hasil' (ranking) dan 'kriterias'
     */
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
        // ---------------------------------------------------------
        // TAHAP PRE-CALCULATION: Menentukan Min/Max
        // ---------------------------------------------------------
        // Menyiapkan array untum menyimpan nilai minimum dan maksimum
        // yang akan digunakan dalam rumus normalisasi.
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
                // Ambil semua nilai dari database
                $nilaiValues = NilaiDaerah::where('kriteria_id', $kId)->pluck('nilai')->toArray();
            }

            if (empty($nilaiValues)) {
                 $minMax[$kId] = ['min' => 0, 'max' => 0];
            } else {
                $minMax[$kId] = [
                    'min' => min($nilaiValues), // Nilai terendah
                    'max' => max($nilaiValues), // Nilai tertinggi
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
                
                // ---------------------------------------------------------
                // TAHAP NORMALISASI (R Matrix)
                // ---------------------------------------------------------
                $normalisasi = 0;
                $min = $minMax[$k->id]['min'];
                $max = $minMax[$k->id]['max'];

                if ($max > 0) { // Cek validasi pembagian nol
                     // BENEFIT: Semakin besar semakin bagus (Profit, Luas Panen, dll)
                     // Rumus: Nilai / Max
                     if ($k->jenis == 'benefit') {
                        $normalisasi = $nilai / $max;
                    } 
                    // COST: Semakin kecil semakin bagus (Biaya, Jarak, Hama, dll)
                    // Rumus: Min / Nilai
                    else {
                        $normalisasi = ($nilai > 0) ? $min / $nilai : 0;
                    }
                }

                // ---------------------------------------------------------
                // TAHAP PREFERENSI (V) / PERANGKINGAN
                // ---------------------------------------------------------
                // Skor Kriteria = Hasil Normalisasi * Bobot Kriteria
                $skor = $normalisasi * $bobot;
                
                // Jumlahkan skor dari semua kriteria untuk mendapatkan Skor Total Daerah
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

        // ---------------------------------------------------------
        // TAHAP 5: Perankingan (Sorting)
        // ---------------------------------------------------------
        // Menggunakan fungsi `usort` (User-defined Sort) dari PHP.
        // Logika: Membandingkan 'skor_total' antar dua item ($a dan $b).
        // `return $b <=> $a` artinya urutkan dari BESAR ke KECIL (Descending).
        // Daerah dengan skor tertinggi akan berada di urutan pertama (indeks 0).
        usort($hasil, function ($a, $b) {
            return $b['skor_total'] <=> $a['skor_total'];
        });

        // Menambahkan atribut 'rank' ke dalam array hasil
        // $index dimulai dari 0, jadi rank = $index + 1 (Juara 1, 2, 3, dst.)
        foreach ($hasil as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        return ['hasil' => $hasil, 'kriterias' => $kriterias];
    }
    
    // ---------------------------------------------------------
    // FUNGSI BANTUAN DATA DUMMY (MOCK DATA)
    // ---------------------------------------------------------
    // Fungsi ini hanya digunakan jika koneksi database GAGAL atau tabel Kriteria KOSONG.
    // Tujuannya agar aplikasi Tetap Bisa Jalan (fallback) saat presentasi/testing
    // meskipun databasenya bermasalah.
    private function getMockKriterias() {
        return collect([
            // Contoh Kriteria 1: Benefit (Semakin tinggi semakin bagus)
            (object)[ 'id' => 1, 'nama_kriteria' => 'Luas Panen (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.35] ],
            // Contoh Kriteria : Cost (Semakin rendah semakin bagus)
            (object)[ 'id' => 3, 'nama_kriteria' => 'Curah Hujan (Contoh)', 'jenis' => 'cost', 'bobotDefault' => (object)['bobot' => 0.20] ],
            (object)[ 'id' => 2, 'nama_kriteria' => 'Produktivitas (Contoh)', 'jenis' => 'benefit', 'bobotDefault' => (object)['bobot' => 0.25] ],
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
