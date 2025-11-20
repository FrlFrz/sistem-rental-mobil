<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitMobil;
use App\Models\JenisMobil;

class UnitMobilController extends Controller
{
    public function index() {
        $unit_mobils = UnitMobil::with('jenis_mobil')->latest()->get();
        $jenisMobils = JenisMobil::all();
        return view('admin.unit_mobil.index', compact('unit_mobils', 'jenisMobils'));
    }

    public function store(Request $request) {
        // dd($request);
        $validateData = $request->validate([
            'id_jenis_mobil' => ['required'],
            'plat_nomor' => ['required', 'string'],
            'warna' => ['required', 'string'],
            'status_mobil' => ['required']
        ]);

        UnitMobil::create($validateData);
        return redirect()->route('unit_mobil.index')->with('success', 'Unit mobil baru berhasil ditambahkan.');
    }

    public function update(Request $request, UnitMobil $unit_mobil) {
        $validateData = $request->validate([
            'id_jenis_mobil' => ['required'],
            'plat_nomor' => ['required', 'string'],
            'warna' => ['required', 'string'],
            'status_mobil' => ['required']
        ]);

        $unit_mobil->update($validateData);
        return redirect()->route('unit_mobil.index')->with('success', 'Unit mobil berhasil diperbarui.');
    }

    public function destroy(UnitMobil $unit_mobil) {
        $unit_mobil->delete();
        return redirect()->route('unit_mobil.index')->with('success', 'Unit mobil berhasil dihapus.');
    }
}
