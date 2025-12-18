<?php

namespace Database\Seeders;

use App\Models\Dropout;
use Illuminate\Database\Seeder;

class DropoutSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Budi Santoso',
                'nim' => '1234567890',
                'fakultas' => 'Teknik',
                'prodi' => 'Teknik Informatika',
                'alasan' => 'Pindah ke kampus lain',
            ],
            [
                'nama' => 'Ani Lestari',
                'nim' => '2345678901',
                'fakultas' => 'Ekonomi',
                'prodi' => 'Manajemen',
                'alasan' => 'Alasan pribadi',
            ],
            [
                'nama' => 'Citra Dewi',
                'nim' => '3456789012',
                'fakultas' => 'Kedokteran',
                'prodi' => 'Kedokteran Umum',
                'alasan' => 'Melanjutkan studi di luar negeri',
            ],
        ];

        foreach ($data as $item) {
            Dropout::create($item);
        }
    }
}
