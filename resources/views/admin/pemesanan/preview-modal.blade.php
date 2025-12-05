{{-- File ini dimuat oleh VerifikasiController@getDetailByToken (sebagai pengganti JSON) --}}
@props(['pemesanan'])

<div id="preview-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true"
     class="hidden fixed inset-0 z-[10001] overflow-y-auto overflow-x-hidden justify-center items-center bg-black/50 mb-10">
     <div class="relative p-4 w-full max-w-xl max-h-full z-40">
        <div class=" bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6">
                <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                    <h3 class="text-2xl font-bold text-green-400">
                        Verifikasi Pemesanan #{{ $pemesanan->id }}
                    </h3>
                    <span class="text-sm font-semibold text-indigo-700 bg-indigo-100 px-3 py-1 rounded-full">
                        Status: {{ strtoupper($pemesanan->status_pemesanan) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-400">

                    <div class="col-span-1 border-r pr-6">
                        <p class="font-extrabold text-indigo-600 uppercase mb-2">DETAIL ASET</p>
                        <p>Model: {{ $pemesanan->UnitMobil->jenis_mobil->merek }} ({{ $pemesanan->UnitMobil->warna }})</p>
                        <p>Plat Nomor: {{ $pemesanan->UnitMobil->plat_nomor }}</p>
                        <p>Durasi: {{ $pemesanan->durasi_rental }} Hari</p>
                        <p>Tgl Mulai: {{ $pemesanan->tgl_mulai }}</p>
                        <p>Tgl Selesai: {{ $pemesanan->tgl_selesai }}</p>
                    </div>

                    <div class="col-span-1 ml-2">
                        <p class="font-extrabold text-indigo-600 uppercase mb-2">DETAIL PENYEWA</p>
                        <p>Nama: {{ $pemesanan->nama_penyewa }}</p>
                        <p>NIK: {{ $pemesanan->nik_penyewa }}</p>
                        <p>Telp: {{ $pemesanan->telepon_penyewa }}</p>
                        <p>Jaminan: {{ strtoupper($pemesanan->jaminan_penyewa) }}</p>
                    </div>
                </div>

                <div class="col-span-2 pt-4 border-t border-gray-200 mt-4">
                    {{-- { asset('storage/pemesanan/' . $pemesanan->foto_ktp_sim) }}" --}}
                    {{-- {{ asset('storage/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }} --}}
                    <p class="font-bold text-gray-400 mb-3">Dokumen dan Bukti Pembayaran:</p>

                    <div class="flex flex-col space-y-4">

                        <div class="w-full border border-gray-300 rounded-lg overflow-hidden">
                            <p class="text-xs font-medium text-green-600 p-2 border-b border-gray-300">FOTO JAMINAN (KTP/SIM)</p>
                            <img src="{{ asset('storage/pemesanan/' . $pemesanan->foto_ktp_sim) }}"
                                alt="Bukti Pembayaran"
                                class="w-full h-48 object-cover"/>
                        </div>

                        @if ($pemesanan->bukti_pembayaran)
                            <div class="w-full border border-gray-300 rounded-lg overflow-hidden">
                                <p class="text-xs font-medium text-green-600 p-2 border-b border-gray-300">BUKTI PEMBAYARAN</p>
                                <img src="{{ asset('storage/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }}"
                                    alt="Bukti Jaminan"
                                    class="w-full h-48 object-cover"/>
                            </div>
                        @else
                            <div class="w-full border border-gray-300 rounded-lg overflow-hidden">
                                <p class="text-xs font-medium text-green-600 p-2 border-b border-gray-300">BUKTI PEMBAYARAN</p>
                                <h1 class="text-red-400">Belum ada</h1>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="mt-6 flex justify-between items-center border-t border-gray-200 pt-4">

                    <div class="text-xl font-extrabold text-blue-400">
                        TOTAL BIAYA: <span class="text-green-600" id="prev_total_biaya-{{ $pemesanan->id }}">
                            Rp 0
                        </span>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" data-modal-hide="preview-modal-{{ $pemesanan->id }}" class="text-gray-600 hover:text-gray-900 font-medium">Tutup</button>
                    </div>
            </div>
        </div>
    </div>
</div>
