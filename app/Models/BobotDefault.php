<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotDefault extends Model
{
    use HasFactory;

    protected $fillable = ['kriteria_id', 'bobot', 'updated_by'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
