<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Surah;

class SurahSeeder extends Seeder
{
    public function run(): void
    {
        $surahList = [
            ['nomor_surah' => 1,   'nama_surah' => 'Al-Fatihah',    'jumlah_ayat' => 7],
            ['nomor_surah' => 2,   'nama_surah' => 'Al-Baqarah',    'jumlah_ayat' => 286],
            ['nomor_surah' => 3,   'nama_surah' => 'Ali Imran',     'jumlah_ayat' => 200],
            ['nomor_surah' => 4,   'nama_surah' => 'An-Nisa',       'jumlah_ayat' => 176],
            ['nomor_surah' => 5,   'nama_surah' => 'Al-Maidah',     'jumlah_ayat' => 120],
            ['nomor_surah' => 6,   'nama_surah' => 'Al-Anam',       'jumlah_ayat' => 165],
            ['nomor_surah' => 7,   'nama_surah' => 'Al-Araf',       'jumlah_ayat' => 206],
            ['nomor_surah' => 18,  'nama_surah' => 'Al-Kahfi',      'jumlah_ayat' => 110],
            ['nomor_surah' => 36,  'nama_surah' => 'Yasin',         'jumlah_ayat' => 83],
            ['nomor_surah' => 55,  'nama_surah' => 'Ar-Rahman',     'jumlah_ayat' => 78],
            ['nomor_surah' => 56,  'nama_surah' => 'Al-Waqiah',     'jumlah_ayat' => 96],
            ['nomor_surah' => 67,  'nama_surah' => 'Al-Mulk',       'jumlah_ayat' => 30],
            ['nomor_surah' => 78,  'nama_surah' => 'An-Naba',       'jumlah_ayat' => 40],
            ['nomor_surah' => 99,  'nama_surah' => 'Az-Zalzalah',   'jumlah_ayat' => 8],
            ['nomor_surah' => 100, 'nama_surah' => 'Al-Adiyat',     'jumlah_ayat' => 11],
            ['nomor_surah' => 108, 'nama_surah' => 'Al-Kautsar',    'jumlah_ayat' => 3],
            ['nomor_surah' => 109, 'nama_surah' => 'Al-Kafirun',    'jumlah_ayat' => 6],
            ['nomor_surah' => 110, 'nama_surah' => 'An-Nasr',       'jumlah_ayat' => 3],
            ['nomor_surah' => 112, 'nama_surah' => 'Al-Ikhlas',     'jumlah_ayat' => 4],
            ['nomor_surah' => 113, 'nama_surah' => 'Al-Falaq',      'jumlah_ayat' => 5],
            ['nomor_surah' => 114, 'nama_surah' => 'An-Nas',        'jumlah_ayat' => 6],
        ];

        foreach ($surahList as $surah) {
            Surah::create($surah);
        }
    }
}