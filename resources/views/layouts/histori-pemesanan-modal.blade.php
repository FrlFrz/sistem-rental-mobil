{{-- partials/pemesanan-detail-modal.blade.php --}}
@props(['pemesanan'])

<div id="detail-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[9999] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative bg-gray-800 rounded-lg shadow-2xl p-6">

            <h3 class="text-2xl font-bold text-white mb-4 border-b border-gray-700 pb-2">
                Detail Pemesanan #{{ $pemesanan->id }}
            </h3>

            {{-- Body Detail --}}
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-300">

                {{-- Kolom 1: Data Penyewa --}}
                <div class="col-span-1 space-y-2">
                    <p><strong>Penyewa:</strong> {{ $pemesanan->nama_penyewa }}</p>
                    <p><strong>NIK:</strong> {{ $pemesanan->nik_penyewa }}</p>
                    <p><strong>Telepon:</strong> {{ $pemesanan->telepon_penyewa }}</p>
                    <p><strong>Jaminan:</strong> {{ ucfirst($pemesanan->jaminan_penyewa) }}</p>
                </div>

                {{-- Kolom 2: Data Keuangan & Unit --}}
                <div class="col-span-1 space-y-2">
                    <p><strong>Unit:</strong> {{ $pemesanan->unitMobil->jenisMobil->merek }}</p>
                    <p><strong>Total Hari:</strong> {{ $pemesanan->durasi_rental }} Hari</p>
                    {{-- <p><strong>Biaya Per Hari:</strong> Rp {{ number_format($pemesanan->unitMobil->jenisMobil->harga_sewa_per_hari, 0, ',', '.') }}</p> --}}
                    <p class="text-lg font-extrabold text-green-400 mt-2">
                        Total Biaya: Rp {{ number_format($pemesanan->total_biaya, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Kolom 3: Alamat (Full Width) --}}
                <div class="col-span-2 pt-3 border-t border-gray-700 mt-4">
                    {{-- <p><strong>Alamat:</strong> {{ $pemesanan->alamat_penyewa }}</p> --}}
                </div>
            </div>

            {{-- Tombol Tutup --}}
            <button data-modal-hide="detail-modal-{{ $pemesanan->id }}" type="button"
                class="absolute top-3 right-3 text-gray-400 hover:text-white">
                &times;
            </button>
        </div>
    </div>
</div>
