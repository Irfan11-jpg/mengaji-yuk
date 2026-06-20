<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (is_null($user->role)) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun tidak memiliki role. Hubungi administrator.',
            ]);
        }

        if ($user->role === 'guru') {
            return redirect()->route('dashboard.guru');
        }

        return redirect()->route('dashboard.santri');
    }
}