<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitMobil;

class DashboardController extends Controller
{
    public function index() {
         $stats = [
            'totalUnitMobil'    => UnitMobil::count(),
            'totalMobilTersedia'=> UnitMobil::where('status_mobil', 'tersedia')->count(),
            'totalMobilDirental'=> UnitMobil::where('status_mobil', 'dirental')->count(),
            'totalMobilDipesan' => UnitMobil::where('status_mobil', 'dipesan')->count()
        ];

        return view('dashboard', compact('stats'));
    }

}
