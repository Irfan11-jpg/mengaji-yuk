<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalan';

    protected $fillable = [
        'santri_id',
        'surah_id',
        'ayat_mulai',
        'ayat_selesai',
        'status',
        'nilai',
        'catatan_guru',
    ];

    public function santri()
    {
        return $this->belongsTo(User::class, 'santri_id');
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}