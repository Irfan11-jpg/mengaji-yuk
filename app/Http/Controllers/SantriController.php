<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hafalan;

class SantriController extends Controller
{
    public function index()
    {
        $santri = Auth::user();

        $hafalan = Hafalan::with('surah')
            ->where('santri_id', $santri->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $total   = $hafalan->count();
        $selesai = $hafalan->where('status', 'selesai')->count();
        $proses  = $hafalan->where('status', 'proses')->count();
        $belum   = $hafalan->where('status', 'belum')->count();

        $rataRata = $hafalan
            ->where('status', 'selesai')
            ->whereNotNull('nilai')
            ->avg('nilai');

        $persenSelesai = $total > 0 ? round(($selesai / $total) * 100) : 0;

        return view('dashboard.santri', compact(
            'santri',
            'hafalan',
            'total',
            'selesai',
            'proses',
            'belum',
            'rataRata',
            'persenSelesai'
        ));
    }
}