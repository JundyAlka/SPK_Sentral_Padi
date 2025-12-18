<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dropout extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'fakultas',
        'prodi',
        'alasan'
    ];
}
