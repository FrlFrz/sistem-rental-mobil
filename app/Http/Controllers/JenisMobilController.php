<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use App\Models\JenisMobil;
use Illuminate\Http\Request;

class JenisMobilController extends Controller
{
    public function index() {
        $jenis_mobils = JenisMobil::latest()->get();
        return view('admin.jenis_mobil.index', compact('jenis_mobils'));
    }

    public function store(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'merek' => ['required', 'string', 'max:255'],
            'tahun' => ['required', 'integer'],
            'kapasitas' => ['required', 'integer', 'min:2', 'max:8'],
            'foto_mobil' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        // dd($validatedData);
        $data = $validatedData;

        if ($request->hasFile('foto_mobil')) {
            $extension = $request->file('foto_mobil')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $destinationPath = storage_path('app/public/jenis_mobil');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            $request->file('foto_mobil')->move($destinationPath, $filename);

            $data['foto_mobil'] = $filename;
        }
        JenisMobil::create($data);

        return redirect()->route('jenis_mobil.index')->with('success', 'Jenis Mobil baru berhasil ditambahkan.');
    }

    public function update(Request $request, JenisMobil $jenis_mobil) {
        // dd($request);
        $validatedData = $request->validate([
            'merek' => ['required', 'string', 'max:255'],
            'tahun' => ['required', 'integer'],
            'kapasitas' => ['required', 'integer', 'min:2', 'max:8'],
            'foto_mobil' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);

        $data = $validatedData;
        // dd($data);
        if($request->hasFile('foto_mobil')) {
            if($jenis_mobil->foto_mobil) {
                Storage::delete('public/jenis_mobil/' . $jenis_mobil->foto_mobil);
            }
            $file = $request->file('foto_mobil');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;

            $destinationPath = storage_path('app/public/jenis_mobil');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $data['foto_mobil'] = $filename;
        } else {
            unset($data['foto_mobil']);
        }
        $jenis_mobil->update($data);

        return redirect()->route('jenis_mobil.index')->with('success', 'Jenis mobil berhasil diperbarui.');
    }

    public function destroy(JenisMobil $jenis_mobil) {
        $styledMerek = "<span class=\"font-extrabold text-white bg-red-600 px-2 py-1 rounded\">{$jenis_mobil->merek}</span>";
        if ($jenis_mobil->unit_mobils()->exists()) {
            return redirect()->route('jenis_mobil.index')->with('error',
                "Model '{$styledMerek}' masih terhubung dengan unit mobil yang ada. Harap hapus atau ubah unit mobil tersebut terlebih dahulu."
            );
        }

        if ($jenis_mobil->foto_mobil) {
            Storage::delete('public/jenis_mobil/' . $jenis_mobil->foto_mobil);
        }

        $jenis_mobil->delete();

        return redirect()->route('jenis_mobil.index')->with('success', 'Jenis mobil berhasil dihapus.');
    }
}
