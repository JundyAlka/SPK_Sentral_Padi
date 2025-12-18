<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiDaerah extends Model
{
    use HasFactory;

    protected $fillable = ['daerah_id', 'kriteria_id', 'nilai'];

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
