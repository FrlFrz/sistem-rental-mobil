<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Pemesanan;
use App\Models\JenisMobil;
use App\Models\UnitMobil;

class PemesananController extends Controller
{
    public function index() {
    $pemesanans = Pemesanan::with('unitMobil.jenis_mobil')->latest()->get();

    $allJenisMobils = JenisMobil::all();

    $unitTersediaCreate = UnitMobil::where('status_mobil', 'tersedia')
                                  ->with('jenis_mobil')
                                  ->get();

    $cascadingDataEdit = [];
    foreach ($pemesanans as $pemesanan) {
        $currentUnit = $pemesanan->unitMobil;

        if ($currentUnit && !$currentUnit->relationLoaded('jenis_mobil')) {
            $currentUnit->load('jenis_mobil');
        }

    $availableUnitsBase = $unitTersediaCreate;

    $allUnitsForDropdown = $availableUnitsBase->toBase()
        ->merge([$currentUnit])
        ->unique('id_unit_mobil')
        ->values();

        if ($pemesanan->id == 1) {
        // dd($allUnitsForDropdown->pluck('id_unit_mobil', 'status_mobil'));
    }
    // dd($cascadingDataEdit);

    $cascadingDataEdit[$pemesanan->id] = $allUnitsForDropdown;
}
    // dd($cascadingDataEdit);
    return view('admin.pemesanan.index', [
        'pemesanans' => $pemesanans,
        'allJenisMobils' => $allJenisMobils,
        'unitTersediaCreate' => $unitTersediaCreate,
        'cascadingDataEdit' => $cascadingDataEdit,
    ]);
    }

    public function store(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'id_unit_mobil' => ['required'],
            'nama_penyewa' => ['required', 'string', 'max:255'],
            'nik_penyewa' => ['required', 'max:18'],
            'telepon_penyewa' => ['required', 'max:13'],
            'alamat_penyewa' => ['required'],
            'jaminan_penyewa' => ['required'],
            'status_pemesanan' => ['required'],
            'foto_ktp_sim' => ['required','image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'tgl_mulai' => ['required'],
            'durasi_rental' => ['required', 'integer'],
            'tgl_selesai' => ['required'],
            'pengiriman' => ['required'],
            'pembayaran' => ['required'],
            'bukti_pembayaran' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'total_biaya' => ['required'],
        ]);

        $data = $validatedData;

        if ($request->hasFile('bukti_pembayaran')) {
            $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $destinationPath = storage_path('app/public/bukti_pembayaran');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            $request->file('bukti_pembayaran')->move($destinationPath, $filename);

            $data['bukti_pembayaran'] = $filename;
        }

        if ($request->hasFile('foto_ktp_sim')) {
            $extension = $request->file('foto_ktp_sim')->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;
            $destinationPath = storage_path('app/public/pemesanan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            $request->file('foto_ktp_sim')->move($destinationPath, $filename);

            $data['foto_ktp_sim'] = $filename;
        }
        // dd($data);

        do {
            $tokenVerifikasi = Str::random(36);
        } while (Pemesanan::where('verification_token', $tokenVerifikasi)->exists());
        $userId = Auth::id();

        $data['verification_token'] = $tokenVerifikasi;
        $data['user_id'] = $userId;

        $pemesanan = Pemesanan::create($data);

        $unit = UnitMobil::find($pemesanan->id_unit_mobil);

        if ($unit) {
            $statusPemesanan = $pemesanan->status_pemesanan;
            $newStatusUnit = $statusPemesanan;

            if ($unit->status_mobil === 'perawatan') {
                return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil, Unit sedang dalam Perawatan.');
            }

            if ($statusPemesanan === 'dipesan' || $statusPemesanan === 'dirental') {
                $newStatusUnit = $statusPemesanan;
            } else { // Jika Selesai atau Dibatalkan
                $newStatusUnit = 'tersedia';
            }

            // Simpan Perubahan
            if ($unit->status_mobil !== $newStatusUnit) {
                $unit->status_mobil = $newStatusUnit;
                $unit->save();
            }
        }

        $user = Auth::user();

        if ($request->has('redirect_to_histori')) {
            $redirectRoute = 'histori.index';
        } elseif ($user && $user->roles === 'admin') {
            // 2. Jika tidak ada input khusus dan user adalah admin, arahkan ke manajemen
            $redirectRoute = 'pemesanan.index';
        } else {
            $redirectRoute = 'histori.index';
        }

        return redirect()->route($redirectRoute)->with('success', 'Pemesanan baru berhasil ditambahkan.');
    }

    public function update(Request $request, Pemesanan $pemesanan) {
        // dd($request);
        $validatedData = $request->validate([
            'id_unit_mobil' => ['required'],
            'nama_penyewa' => ['required', 'string', 'max:255'],
            'nik_penyewa' => ['required', 'max:18'],
            'telepon_penyewa' => ['required', 'max:13'],
            'alamat_penyewa' => ['required'],
            'jaminan_penyewa' => ['required'],
            'status_pemesanan' => ['required'],
            'foto_ktp_sim' => ['nullable','image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'tgl_mulai' => ['required'],
            'durasi_rental' => ['required', 'integer'],
            'tgl_selesai' => ['required'],
            'pengiriman' => ['required'],
            'pembayaran' => ['required'],
            'bukti_pembayaran' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'total_biaya' => ['required'],
        ]);

        $data = $validatedData;
        // dd($data);
        if($request->hasFile('bukti_pembayaran')) {
            if($pemesanan->bukti_pembayaran) {
                $pathFotoLengkap = 'bukti_pembayaran' . '/' . $pemesanan->bukti_pembayaran;
                if(Storage::disk('public')->exists($pathFotoLengkap)) {
                    Storage::disk('public')->delete($pathFotoLengkap);
                }
            }
            $file = $request->file('bukti_pembayaran');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;

            $destinationPath = storage_path('app/public/bukti_pembayaran');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $data['bukti_pembayaran'] = $filename;
        } else {
            unset($data['bukti_pembayaran']);
        }

        if($request->hasFile('foto_ktp_sim')) {
            if($pemesanan->foto_ktp_sim) {
                $pathFotoLengkap = 'pemesanan' . '/' . $pemesanan->foto_ktp_sim;
                if(Storage::disk('public')->exists($pathFotoLengkap)) {
                    Storage::disk('public')->delete($pathFotoLengkap);
                }
            }
            $file = $request->file('foto_ktp_sim');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $extension;

            $destinationPath = storage_path('app/public/pemesanan');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $file->move($destinationPath, $filename);
            $data['foto_ktp_sim'] = $filename;
        } else {
            unset($data['foto_ktp_sim']);
        }

        $idUnitLama = $pemesanan->id_unit_mobil;

        $pemesanan->update($data);

        if ($request->id_unit_mobil !== $idUnitLama) {

            $unitLama = UnitMobil::find($idUnitLama);

            if ($unitLama) {
                $unitLama->status_mobil = 'tersedia';
                $unitLama->save();
            }
        }

        $status = $data['status_pemesanan'];
        if($pemesanan) {
            $unit = UnitMobil::find($pemesanan->id_unit_mobil);

            if ($unit) {
                if($status == "dipesan" || $status == "dirental") {
                    $unit->status_mobil = $status;

                } else {
                    $unit->status_mobil = "tersedia";
                }
                $unit->save();
            }
        }

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy(Pemesanan $pemesanan) {
        $unit = $pemesanan->unitMobil;

        if ($unit) {
            $activeBookingsExist = Pemesanan::where('id_unit_mobil', $unit->id_unit_mobil)
                                        ->whereIn('status_pemesanan', ['dipesan', 'dirental'])
                                        ->where('id', '!=', $pemesanan->id)
                                        ->exists();

            if (!$activeBookingsExist) {
                if ($unit->status_mobil !== 'perawatan') { // JANGAN ubah jika sedang perawatan
                    $unit->status_mobil = 'tersedia';
                    $unit->save();
                }
            }
            // Jika ada pemesanan aktif lain, biarkan status unit tetap (dipesan/dirental).
        }

        if ($pemesanan->bukti_pembayaran) {
            $pathFotoLengkap = 'bukti_pembayaran' . '/' . $pemesanan->bukti_pembayaran;

            if (Storage::disk('public')->exists($pathFotoLengkap)) {
                Storage::disk('public')->delete($pathFotoLengkap);
            }
        }

        if ($pemesanan->foto_ktp_sim) {
            $pathFotoLengkap = 'pemesanan' . '/' . $pemesanan->foto_ktp_sim;

            if (Storage::disk('public')->exists($pathFotoLengkap)) {
                Storage::disk('public')->delete($pathFotoLengkap);
            }
        }

        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }

    public function downloadQrCode(Request $request, $token) {
        $returnTo = $request->query('return_to') ?? route('pemesanan.index');

        return view('admin.verifikasi.qr_konversi_page', compact('token', 'returnTo'));
    }

    public function konfirmasiAksi(Request $request, Pemesanan $pemesanan) {
        $path = $request->path();

        if (str_contains($path, 'konfirmasi')) {
            $newPemesananStatus = 'dirental';
            $newUnitStatus = 'dirental';
            $message = 'Serah terima kunci berhasil. Unit telah berstatus Dirental.';
        } elseif (str_contains($path, 'pengembalian')) {
            $newPemesananStatus = 'selesai';
            $newUnitStatus = 'tersedia';
            $message = 'Pengembalian unit berhasil dikonfirmasi.';
        } else {
            return redirect()->back()->with('error', 'Aksi tidak valid.');
        }

        DB::transaction(function () use ($pemesanan, $newPemesananStatus, $newUnitStatus) {

            $unit = $pemesanan->unitMobil;

            $pemesanan->status_pemesanan = $newPemesananStatus;

            if ($newPemesananStatus === 'dirental') {
                 $pemesanan->diserahkan_oleh = Auth::id();
                 $pemesanan->tgl_verifikasi = now();
            }
            if ($newPemesananStatus === 'selesai') {
                 $pemesanan->tgl_kembali_aktual = now();
            }
            $pemesanan->save();

            if ($unit && $unit->status_mobil !== 'perawatan') {

                if ($newPemesananStatus === 'selesai' || $newPemesananStatus === 'dibatalkan') {
                    $unit->status_mobil = 'tersedia';
                } else {
                    $unit->status_mobil = $newUnitStatus;
                }
                $unit->save();
            }
        });

        return redirect()->route('verifikasi-pelanggan')->with('success', $message);
    }

    public function historiRental() {
        $userId = Auth::id();
        $selectHistoriUser = Pemesanan::with('unitMobil.jenis_mobil')->where('user_id', $userId)->latest()->get();

        return view('layouts.histori-rental', compact('selectHistoriUser'));
    }

    public function getDetailRiwayat($id) {
        $pemesanan = Pemesanan::with('unitMobil.jenis_mobil')->where('id', $id)->first();

        if (!$pemesanan) {
            return response()->json(['success' => false, 'message' => 'Id tidak valid.'], 404);
        }

        return response()->json([
            'success' => true,
            'pemesanan' => $pemesanan
        ]);
    }

    public function showCheckoutForm(JenisMobil $jenis_mobil) {
        $availableUnits = UnitMobil::with('jenis_mobil')
                                    ->where('id_jenis_mobil', $jenis_mobil->id_jenis_mobil)
                                    ->where('status_mobil', 'tersedia')
                                    ->first();

        return view('layouts.checkout', compact('jenis_mobil', 'availableUnits'));
    }
}
