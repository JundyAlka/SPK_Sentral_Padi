<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\BobotDefault;
use App\Models\NilaiDaerah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Clean Database
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Daerah::truncate();
        Kriteria::truncate();
        BobotDefault::truncate();
        NilaiDaerah::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Insert Users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pengguna Umum',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // 3. Insert Kriteria
        $kriterias = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Luas Panen (ha)',
                'jenis' => 'benefit',
                'bobot' => 0.40
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Produksi Padi (ton)',
                'jenis' => 'benefit',
                'bobot' => 0.25
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Produktivitas Padi (ku/ha)',
                'jenis' => 'benefit',
                'bobot' => 0.25
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Lahan Sawah Irigasi',
                'jenis' => 'benefit',
                'bobot' => 0.10
            ],
        ];

        foreach ($kriterias as $k) {
            $newKriteria = Kriteria::create([
                'kode_kriteria' => $k['kode_kriteria'],
                'nama_kriteria' => $k['nama_kriteria'],
                'jenis' => $k['jenis'],
            ]);

            BobotDefault::create([
                'kriteria_id' => $newKriteria->id,
                'bobot' => $k['bobot'],
            ]);
        }

        // 4. Insert Daerah & Nilai (Campuran Provinsi)
        $dataDaerah = [
            // Jawa Tengah
            ['Cilacap', 106346.75, 651135.71, 61.23, 47284, 'Jawa Tengah'],
            ['Banyumas', 45113.99, 238181.19, 52.8, 25540, 'Jawa Tengah'],
            ['Kebumen', 72338.28, 374547.12, 51.78, 25906, 'Jawa Tengah'],
            ['Klaten', 54219.39, 304870.91, 56.23, 30946, 'Jawa Tengah'],
            ['Sragen', 111694.08, 732281.33, 65.56, 25366, 'Jawa Tengah'],
            
            // Jawa Timur
            ['Blitar', 30789.76, 171154.02, 55.59, 26483, 'Jawa Timur'],
            ['Kediri', 30496.57, 174072.2, 57.08, 35118, 'Jawa Timur'],
            ['Malang', 41019.97, 254793.72, 62.11, 35060, 'Jawa Timur'],
            ['Jember', 120069.41, 623264.88, 51.91, 77773, 'Jawa Timur'],
            ['Banyuwangi', 67240.56, 395631.38, 58.84, 47965, 'Jawa Timur'],

            // Jawa Barat & DIY
            ['Sukabumi', 81612.30, 466835.93, 57.2, 46811, 'Jawa Barat'],
            ['Cianjur', 105305.70, 630847.78, 59.91, 40068, 'Jawa Barat'],
            ['Indramayu', 212866.19, 1399352.12, 65.74, 95558, 'Jawa Barat'],
            ['Karawang', 183065.46, 1041530.95, 56.89, 90032, 'Jawa Barat'],
            ['Kota Yogyakarta', 11.43, 58.29, 51, 58, 'DI Yogyakarta'],
        ];

        // Get IDs of Kriterias
        $c1 = Kriteria::where('kode_kriteria', 'C1')->first()->id;
        $c2 = Kriteria::where('kode_kriteria', 'C2')->first()->id;
        $c3 = Kriteria::where('kode_kriteria', 'C3')->first()->id;
        $c4 = Kriteria::where('kode_kriteria', 'C4')->first()->id;

        foreach ($dataDaerah as $d) {
            $daerah = Daerah::create([
                'nama_daerah' => $d[0],
                'provinsi' => $d[5], 
            ]);

            // C1
            NilaiDaerah::create(['daerah_id' => $daerah->id, 'kriteria_id' => $c1, 'nilai' => $d[1]]);
            // C2
            NilaiDaerah::create(['daerah_id' => $daerah->id, 'kriteria_id' => $c2, 'nilai' => $d[2]]);
            // C3
            NilaiDaerah::create(['daerah_id' => $daerah->id, 'kriteria_id' => $c3, 'nilai' => $d[3]]);
            // C4
            NilaiDaerah::create(['daerah_id' => $daerah->id, 'kriteria_id' => $c4, 'nilai' => $d[4]]);
        }
    }
}
