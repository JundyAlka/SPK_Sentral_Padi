<?php

namespace App\Models;

class Transaksi
{
    // Data array disimpan di dalam class Transaksi
    /**
     * Sumber data mentah (array asosiatif per pegawai)
     */
    private array $items;
    /**
     * Daftar kunci kriteria untuk perhitungan rata-rata
     */
    private array $kriteria = ['kinerja','disiplin','pribadi','kreatif','aktif','peduli'];

    public function __construct()
    {
        $this->items = [
            [
                'nama' => 'Drs. Bambang Setya Sudarmo',
                'kinerja' => 65,
                'disiplin' => 55,
                'pribadi' => 72,
                'kreatif' => 90,
                'aktif' => 75,
                'peduli' => 60,
            ],
            [
                'nama' => 'Faisal Heriyanto',
                'kinerja' => 70,
                'disiplin' => 90,
                'pribadi' => 50,
                'kreatif' => 95,
                'aktif' => 50,
                'peduli' => 57,
            ],
            [
                'nama' => 'Iyan Rusyaman',
                'kinerja' => 100,
                'disiplin' => 95,
                'pribadi' => 95,
                'kreatif' => 95,
                'aktif' => 95,
                'peduli' => 95,
            ],
        ];
    }

    // Metode getData() mengembalikan seluruh data pegawai untuk ditampilkan di view
    public function getData(): array
    {
        return $this->items;
    }

    /**
     * Ambil data lengkap beserta kolom computed (rata-rata & peringkat)
     */
    public function all(): array
    {
        $rows = $this->appendAverages($this->items);
        $rows = $this->appendRanks($rows);
        return $rows;
    }

    private function appendAverages(array $rows): array
    {
        foreach ($rows as $i => $r) {
            $sum = 0;
            foreach ($this->kriteria as $k) {
                $sum += $r[$k];
            }
            $rows[$i]['rata'] = round($sum / count($this->kriteria), 2);
        }
        return $rows;
    }

    private function appendRanks(array $rows): array
    {
        $sorted = $rows;
        usort($sorted, function ($a, $b) {
            if ($b['rata'] === $a['rata']) {
                // fallback agar penentuan stabil (berdasarkan nama)
                return strcmp($a['nama'], $b['nama']);
            }
            return $b['rata'] <=> $a['rata'];
        });

        $rankMap = [];
        $rank = 1;n
        foreach ($sorted as $row) {
            $key = $row['nama'];
            if (!isset($rankMap[$key])) {
                $rankMap[$key] = $rank;
            }
            $rank++;
        }

        foreach ($rows as $i => $r) {
            $rows[$i]['peringkat'] = $rankMap[$r['nama']] ?? null;
        }
        return $rows;
    }
}
