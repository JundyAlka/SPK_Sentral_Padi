<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::insert([
            [
                'nim' => '070010327',
                'nama_lengkap' => 'Andi Gunawan',
                'alamat' => 'Boro Kidul',
                'no_hp' => '08968934984',
                'email' => 'andi22@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '080010486',
                'nama_lengkap' => 'Feri Ardi',
                'alamat' => 'Cangkrep',
                'no_hp' => '089089237523',
                'email' => 'feri9@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '090010090',
                'nama_lengkap' => 'Ifan Bachdim',
                'alamat' => 'Ngrombol',
                'no_hp' => '08778477382',
                'email' => 'ifanski@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '100010607',
                'nama_lengkap' => 'Beckham Arya',
                'alamat' => 'Prembun',
                'no_hp' => '09776489308',
                'email' => 'beckhm@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '110010227',
                'nama_lengkap' => 'Saputra Inggr Wicaksono',
                'alamat' => 'Prembun',
                'no_hp' => '07998298398',
                'email' => 'saputra_iw@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '110010261',
                'nama_lengkap' => 'Bambang Pamungkas',
                'alamat' => 'Ngombol',
                'no_hp' => '09888773782',
                'email' => 'Bambang_p@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
