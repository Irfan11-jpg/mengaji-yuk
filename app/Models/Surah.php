<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    protected $table = 'surah';

    protected $fillable = [
        'nomor_surah',
        'nama_surah',
        'jumlah_ayat',
    ];

    public function hafalan()
    {
        return $this->hasMany(Hafalan::class);
    }
}