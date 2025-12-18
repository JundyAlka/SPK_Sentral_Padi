<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    
    protected $fillable = [
        'judul',
        'author',
        'kategori',
        'tanggal_posting',
        'waktu_posting',
        'isi_berita',
        'foto'
    ];

    protected $dates = [
        'tanggal_posting',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_posting' => 'date:Y-m-d',
    ];

    public static function getAll()
    {
        return self::all();
    }

    public function simpan($data)
    {
        return $this->create($data);
    }
}
