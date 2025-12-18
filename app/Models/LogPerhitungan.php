<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPerhitungan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'executed_at', 'keterangan'];

    protected $casts = [
        'executed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
