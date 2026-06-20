<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hafalan;

class GuruController extends Controller
{
    public function index()
    {
        $santriList = User::where('role', 'santri')
            ->withCount('hafalan')
            ->with(['hafalan' => function ($q) {
                $q->with('surah')->orderBy('created_at', 'desc');
            }])
            ->orderBy('name', 'asc')
            ->get();

        $totalSantri    = $santriList->count();
        $totalHafalan   = Hafalan::count();
        $hafalanSelesai = Hafalan::where('status', 'selesai')->count();
        $hafalanProses  = Hafalan::where('status', 'proses')->count();

        $rataRataGlobal = Hafalan::where('status', 'selesai')
            ->whereNotNull('nilai')
            ->avg('nilai');

        return view('dashboard.guru', compact(
            'santriList',
            'totalSantri',
            'totalHafalan',
            'hafalanSelesai',
            'hafalanProses',
            'rataRataGlobal'
        ));
    }
}