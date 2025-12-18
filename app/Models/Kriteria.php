<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kriteria', 'jenis'];

    public function bobotDefault()
    {
        return $this->hasOne(BobotDefault::class);
    }

    public function nilaiDaerah()
    {
        return $this->hasMany(NilaiDaerah::class);
    }
}
