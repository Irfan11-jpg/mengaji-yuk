<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hafalan;
use App\Models\User;
use App\Models\Surah;

class HafalanSeeder extends Seeder
{
    public function run(): void
    {
        $budi  = User::where('email', 'budi@mengajiyuk.com')->first();

        $fatihah  = Surah::where('nomor_surah', 1)->first();
        $ikhlas   = Surah::where('nomor_surah', 112)->first();
        $naas     = Surah::where('nomor_surah', 114)->first();
        $mulk     = Surah::where('nomor_surah', 67)->first();
        $yasin    = Surah::where('nomor_surah', 36)->first();
        $falaq    = Surah::where('nomor_surah', 113)->first();
        $nasr     = Surah::where('nomor_surah', 110)->first();
        $kafirun  = Surah::where('nomor_surah', 109)->first();
        $kautsar  = Surah::where('nomor_surah', 108)->first();

        // Hafalan Budi
        Hafalan::create(['santri_id' => $budi->id, 'surah_id' => $fatihah->id,  'ayat_mulai' => 1, 'ayat_selesai' => 7,  'status' => 'selesai', 'nilai' => 90, 'catatan_guru' => 'Bagus, tajwid sudah benar.']);
        Hafalan::create(['santri_id' => $budi->id, 'surah_id' => $ikhlas->id,   'ayat_mulai' => 1, 'ayat_selesai' => 4,  'status' => 'selesai', 'nilai' => 85, 'catatan_guru' => 'Perlu perbaiki makhraj huruf qaf.']);
        Hafalan::create(['santri_id' => $budi->id, 'surah_id' => $naas->id,     'ayat_mulai' => 1, 'ayat_selesai' => 6,  'status' => 'proses',  'nilai' => null, 'catatan_guru' => null]);
        Hafalan::create(['santri_id' => $budi->id, 'surah_id' => $mulk->id,     'ayat_mulai' => 1, 'ayat_selesai' => 30, 'status' => 'belum',   'nilai' => null, 'catatan_guru' => null]);

    }
}