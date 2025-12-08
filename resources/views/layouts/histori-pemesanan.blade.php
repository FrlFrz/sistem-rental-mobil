<x-user-page-template>
    @section('title', 'Riwayat Pemesanan')

    <x-navigation-user>
        {{-- Bagian Info Pengguna (Nama & Email) --}}
        <div class="px-4 py-4" role="none">
            <p class="text-lg font-extrabold text-gray-900 mb-1 leading-tight">
                {{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}
            </p>
            <p class="text-sm font-semibold text-[#ffa602]">
                {{ Auth::user()->email }}
            </p>
        </div>

        <div class="py-1" role="none">

            {{-- Opsi Khusus Admin: Tampil jika roles adalah 'admin' --}}
            @if (Auth::user()->roles === 'admin')
                <a href="{{ route('dashboard') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                    <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Dashboard Admin
                </a>
            @endif

            {{-- Opsi Umum (Profil Saya) --}}
            <a href="{{ url('user-profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil Saya
            </a>

            {{-- Opsi Umum (Histori Pemesanan) --}}
            <a href="{{ route('histori-pemesanan') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Histori Pemesanan
            </a>

            {{-- Opsi Umum (Keluar) --}}
            <form method="POST" action="{{ route('logout') }}" class="block w-full text-left" role="none">
                @csrf
                <button type="submit" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-red-500 hover:text-white transition duration-150 w-full">
                    <svg class="w-5 h-5 mr-3 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-4a3 3 0 013-3h3m0-3V6a3 3 0 013-3h4a3 3 0 013 3v2"></path></svg>
                    Keluar
                </button>
            </form>

        </div>
    </x-navigation-user>

<main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 lg:p-8">

            {{-- Judul Halaman --}}
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b border-gray-200 pb-3">
                <i class="fa-solid fa-clock-rotate-left mr-2"></i> Riwayat Pemesanan Saya
            </h2>

            <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($selectHistoriUser as $pemesanan)
                    @php
                        $status = strtolower($pemesanan->status_pemesanan);
                        $badgeClass = '';
                        if ($status == 'dipesan' || $status == 'menunggu_verifikasi') {
                            $badgeClass = 'bg-blue-100 text-blue-800';
                        } elseif ($status == 'dirental') {
                            $badgeClass = 'bg-yellow-100 text-yellow-800';
                        } elseif ($status == 'selesai') {
                            $badgeClass = 'bg-green-100 text-green-800';
                        } else {
                            $badgeClass = 'bg-red-100 text-red-800';
                        }
                    @endphp

                    <div class="bg-gray-50 p-4 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition duration-300 flex flex-col justify-between h-full">

                        <div class="mb-3">
                            <span class="text-xs font-semibold text-gray-500 uppercase block">ID: #{{ $pemesanan->id }}</span>
                            <span class="text-lg font-extrabold text-gray-900 block truncate">
                                {{ $pemesanan->unitMobil->jenis_mobil->merek }}
                            </span>
                            <span class="text-sm text-gray-700 block">
                                Plat: {{ $pemesanan->unitMobil->plat_nomor }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-x-2 text-xs mb-3 border-y border-gray-200 py-2">
                            <div>
                                <p class="text-gray-800 font-medium">Mulai:</p>
                                <p class="text-gray-600">{{ \Carbon\Carbon::parse($pemesanan->tgl_mulai)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-800 font-medium">Selesai:</p>
                                <p class="text-gray-600">{{ \Carbon\Carbon::parse($pemesanan->tgl_selesai)->format('d M Y') }}</p>
                            </div>
                            <div class="col-span-2 mt-1">
                                <p class="text-gray-500">Durasi: {{ $pemesanan->durasi_rental }} Hari</p>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                {{-- Status Badge --}}
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $pemesanan->status_pemesanan)) }}
                                </span>


                            </div>

                            <div class="flex justify-between items-center pt-1 border-t border-gray-200">
                                <span class="text-lg font-extrabold text-red-600">
                                    <span class="text-sm text-gray-600">Total:</span> Rp {{ number_format($pemesanan->total_biaya, 0, ',', '.') }}
                                </span>

                                <div class="flex space-x-2">
                                    @if ($status != 'selesai')
                                        <a href="{{ route('pemesanan.qr.konversi', ['token' => $pemesanan->verification_token, 'return_to' => url()->current()]) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition duration-150"
                                            title="Unduh QR Code"
                                        >
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75v-2.25M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    @endif
                                    <button
                                        type="button"
                                        data-modal-target="detail-modal-{{ $pemesanan->id }}"
                                        data-modal-toggle="detail-modal-{{ $pemesanan->id }}"
                                        class="px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 transition duration-150"
                                    >
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full text-center text-gray-500 py-10 bg-white rounded-lg shadow-inner">
                        <i class="fa-solid fa-box-open text-4xl mb-3"></i>
                        <p class="text-lg font-medium">Anda belum memiliki riwayat pemesanan.</p>
                        <p>Mulai rental mobil pertama Anda sekarang!</p>
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </div>
</main>

    @foreach ($selectHistoriUser as $pemesanan)
        @php
            // Definisikan badge class berdasarkan status
            $badgeClass = match($pemesanan->status_pemesanan) {
                'pending' => 'bg-yellow-100 text-yellow-800',
                'dikonfirmasi' => 'bg-blue-100 text-blue-800',
                'sedang_berjalan' => 'bg-green-100 text-green-800',
                'selesai' => 'bg-gray-100 text-gray-800',
                'dibatalkan' => 'bg-red-100 text-red-800',
                default => 'bg-gray-100 text-gray-800'
            };
        @endphp

        <div id="detail-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-xl max-h-full">
                {{-- Modal content --}}
                <div class="relative bg-white rounded-xl shadow-2xl max-h-[90vh] flex flex-col">
                    {{-- Modal header dengan gradien --}}
                    <div class="bg-blue-500 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-white">
                                    Detail Pemesanan
                                </h3>
                                <p class="text-indigo-100 text-sm mt-1">ID: #{{ $pemesanan->id }}</p>
                            </div>
                            <button type="button"
                                    class="text-white hover:bg-white hover:bg-opacity-20 rounded-lg text-sm w-10 h-10 inline-flex justify-center items-center transition-all"
                                    data-modal-hide="detail-modal-{{ $pemesanan->id }}">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </div>

                    {{-- Modal body --}}
                    <div class="p-6 space-y-6 overflow-y-auto flex-1">

                        {{-- Status Badge --}}
                        <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4">
                            <span class="text-sm font-semibold text-gray-700">Status Pemesanan:</span>
                            <span class="px-4 py-2 text-sm font-bold rounded-full {{ $badgeClass }}">
                                {{ ucfirst(str_replace('_', ' ', $pemesanan->status_pemesanan)) }}
                            </span>
                        </div>

                        {{-- Informasi Penyewa --}}
                        <div class="bg-white border border-gray-200 rounded-lg p-5">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informasi Penyewa
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Nama Lengkap</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $pemesanan->nama_penyewa }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">NIK</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $pemesanan->nik_penyewa }}</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">No. Telepon</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $pemesanan->telepon_penyewa }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Jenis Jaminan</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ strtoupper($pemesanan->jaminan_penyewa) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Foto KTP/SIM --}}
                        <div class="bg-white border border-gray-200 rounded-lg p-5">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Dokumen Identitas (KTP/SIM)
                            </h4>
                            @if($pemesanan->foto_ktp_sim)
                                <div class="relative group">
                                    <img src="{{ asset('storage/pemesanan/' . $pemesanan->foto_ktp_sim) }}"
                                        alt="Foto KTP/SIM"
                                        class="w-full h-64 object-cover rounded-lg border-2 border-gray-300 shadow-sm hover:shadow-lg transition-shadow cursor-pointer"
                                        onclick="window.open(this.src, '_blank')">
                                    {{-- <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all flex items-center justify-center">
                                        <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity bg-black bg-opacity-70 px-4 py-2 rounded-lg text-sm">
                                            Klik untuk memperbesar
                                        </span>
                                    </div> --}}
                                </div>
                            @else
                                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Dokumen belum diunggah</p>
                                </div>
                            @endif
                        </div>

                        {{-- Bukti Pembayaran --}}
                        <div class="bg-white border border-gray-200 rounded-lg p-5">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Bukti Pembayaran
                            </h4>
                            @if($pemesanan->foto_ktp_sim)
                                <div class="relative group">
                                    <img src="{{ asset('storage/bukti_pembayaran/' . $pemesanan->bukti_pembayaran) }}"
                                        alt="Foto KTP/SIM"
                                        class="w-full h-64 object-cover rounded-lg border-2 border-gray-300 shadow-sm hover:shadow-lg transition-shadow cursor-pointer"
                                        onclick="window.open(this.src, '_blank')">
                                    {{-- <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all flex items-center justify-center">
                                        <span class="text-white opacity-0 group-hover:opacity-100 transition-opacity bg-black bg-opacity-70 px-4 py-2 rounded-lg text-sm">
                                            Klik untuk memperbesar
                                        </span>
                                    </div> --}}
                                </div>
                            @else
                                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Dokumen belum diunggah</p>
                                </div>
                            @endif
                        </div>

                        {{-- Informasi Kendaraan --}}
                        <div class="bg-white border border-gray-200 rounded-lg p-5">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                                </svg>
                                Informasi Rental
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Merek/Tipe</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $pemesanan->unitMobil->jenis_mobil->merek }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Tanggal Mulai / Selesai</p>
                                        <p class="text-sm font-mono font-bold text-gray-600">
                                            {{ $pemesanan->tgl_mulai }} / {{ $pemesanan->tgl_selesai }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Kode Verifikasi</p>
                                        <p class="text-sm font-mono font-bold text-indigo-600 bg-indigo-50 px-3 py-2 rounded-lg inline-block">
                                            {{ $pemesanan->verification_token }}
                                        </p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Plat Nomor</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $pemesanan->unitMobil->plat_nomor }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Durasi Rental</p>
                                        <p class="text-sm font-mono font-bold text-gray-600">
                                            {{ $pemesanan->durasi_rental }} hari
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Total Biaya --}}
                        <div class="bg-gradient-to-br from-red-50 to-orange-50 border-2 border-red-200 rounded-lg p-5">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-800">Total Biaya Rental</span>
                                <span class="text-3xl font-extrabold text-red-600">
                                    Rp {{ number_format($pemesanan->total_biaya, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- Modal footer --}}
                    <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50">
                        <div class="flex gap-3">
                            {{-- @if ($pemesanan->status_pemesanan == 'dipesan' || $pemesanan->status_pemesanan == 'menunggu_verifikasi')
                                <a href="#"
                                class="inline-flex items-center gap-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg px-5 py-2.5 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Unduh Bukti Pemesanan
                                </a>
                            @endif --}}
                        </div>
                        <button data-modal-hide="detail-modal-{{ $pemesanan->id }}"
                                type="button"
                                class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-300 text-sm font-medium px-5 py-2.5 transition-all">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-user-page-template>
