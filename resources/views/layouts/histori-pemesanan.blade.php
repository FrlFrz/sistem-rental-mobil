<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Flowbite CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="bg-gray-100">
    @php
    // Definisikan data statis untuk debugging tampilan
    $staticPemesanan = [
        (object)[
            'id' => 12301,
            'unitMobil' => (object)['plat_nomor' => 'B 4567 XY', 'jenisMobil' => (object)['merek' => 'Toyota Avanza']],
            'nama_penyewa' => 'Budi Santoso',
            'tgl_mulai' => '2025-11-20',
            'tgl_selesai' => '2025-11-27',
            'durasi_rental' => 7,
            'total_biaya' => 1750000,
            'jaminan_penyewa' => 'KTP',
            'telepon_penyewa' => '0897-6429-0176',
            'nik_penyewa' => '131433535',
            'status_pemesanan' => 'dirental',
            'verification_token' => 'TOK2A7B4',
        ],
        (object)[
            'id' => 12302,
            'unitMobil' => (object)['plat_nomor' => 'N 8890 ZZ', 'jenisMobil' => (object)['merek' => 'Honda Brio']],
            'nama_penyewa' => 'Citra Dewi',
            'tgl_mulai' => '2025-10-01',
            'tgl_selesai' => '2025-10-06',
            'durasi_rental' => 5,
            'total_biaya' => 750000,
            'jaminan_penyewa' => 'SIM A',
            'telepon_penyewa' => '0897-6429-0176',
            'nik_penyewa' => '131433535',
            'status_pemesanan' => 'selesai',
            'verification_token' => 'TOK5C3F9',
        ],
        (object)[
            'id' => 12303,
            'unitMobil' => (object)['plat_nomor' => 'W 1122 OP', 'jenisMobil' => (object)['merek' => 'Suzuki Ertiga']],
            'nama_penyewa' => 'Dhani Pratama',
            'tgl_mulai' => '2025-12-05',
            'tgl_selesai' => '2025-12-08',
            'durasi_rental' => 3,
            'total_biaya' => 600000,
            'jaminan_penyewa' => 'Paspor',
            'telepon_penyewa' => '0897-6429-0176',
            'nik_penyewa' => '131433535',
            'status_pemesanan' => 'dipesan',
            'verification_token' => 'TOK9D2A1',
        ],
    ];
    $pemesanans = collect($staticPemesanan); // Konversi array ke Laravel Collection
    @endphp

    @include('components.navigation-user')

<main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-6 lg:p-8">

            {{-- Judul Halaman --}}
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b border-gray-200 pb-3">
                <i class="fa-solid fa-clock-rotate-left mr-2"></i> Riwayat Pemesanan Saya
            </h2>

            <div class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($pemesanans as $pemesanan)
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
                                {{ $pemesanan->unitMobil->jenisMobil->merek }}
                            </span>
                            <span class="text-sm text-gray-700 block">
                                Plat: **{{ $pemesanan->unitMobil->plat_nomor }}**
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
                                <p class="text-gray-500">Durasi: **{{ $pemesanan->durasi_rental }} Hari**</p>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <div class="flex justify-between items-center">
                                {{-- Status Badge --}}
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $pemesanan->status_pemesanan)) }}
                                </span>

                                <span class="text-sm text-gray-600">Total:</span>
                            </div>

                            <div class="flex justify-between items-center pt-1 border-t border-gray-200">
                                <span class="text-lg font-extrabold text-red-600">
                                    Rp {{ number_format($pemesanan->total_biaya, 0, ',', '.') }}
                                </span>

                                <div class="flex space-x-2">
                                    @if ($status != 'selesai')
                                        <a href="#"
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

    @foreach ($pemesanans as $pemesanan)
        <div id="detail-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                {{-- Modal content --}}
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    {{-- Modal header --}}
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Detail Pemesanan #{{ $pemesanan->id }}
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-modal-{{ $pemesanan->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    {{-- Modal body --}}
                    <div class="p-4 md:p-5 space-y-4">
                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-700 dark:text-gray-400">
                            {{-- KOLOM KIRI --}}
                            <div class="space-y-2">
                                <p><span class="font-semibold text-gray-900 dark:text-white">Penyewa:</span> {{ $pemesanan->nama_penyewa }}</p>
                                <p><span class="font-semibold text-gray-900 dark:text-white">NIK:</span> {{ $pemesanan->nik_penyewa }}</p>
                                <p><span class="font-semibold text-gray-900 dark:text-white">Telepon:</span> {{ $pemesanan->telepon_penyewa }}</p>
                                <p><span class="font-semibold text-gray-900 dark:text-white">Jaminan:</span> {{ $pemesanan->jaminan_penyewa }}</p>
                            </div>
                            {{-- KOLOM KANAN --}}
                            <div class="space-y-2">
                                <p><span class="font-semibold text-gray-900 dark:text-white">Unit Mobil:</span> {{ $pemesanan->unitMobil->jenisMobil->merek }}</p>
                                <p><span class="font-semibold text-gray-900 dark:text-white">Plat Nomor:</span> {{ $pemesanan->unitMobil->plat_nomor }}</p>
                                <p><span class="font-semibold text-gray-900 dark:text-white">Kode Verifikasi:</span> **{{ $pemesanan->verification_token }}**</p>
                                <p><span class="font-semibold text-gray-900 dark:text-white">Total Biaya:</span> <span class="text-lg font-bold text-red-600">Rp {{ number_format($pemesanan->total_biaya, 0, ',', '.') }}</span></p>
                            </div>
                        </div>

                        {{-- Status di bagian bawah modal --}}
                        <div class="mt-4 pt-4 border-t border-gray-200">
                             <p class="text-sm font-semibold">Status Saat Ini:</p>
                             <span class="px-3 py-1 text-sm font-bold rounded-full mt-1 inline-block {{ $badgeClass }}">
                                {{ ucfirst(str_replace('_', ' ', $pemesanan->status_pemesanan)) }}
                             </span>
                        </div>
                    </div>
                    {{-- Modal footer --}}
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        @if ($pemesanan->status_pemesanan == 'dipesan' || $pemesanan->status_pemesanan == 'menunggu_verifikasi')
                           <a href="#" class="text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg px-5 py-2.5 text-center mr-2">
                                Unduh Bukti Pemesanan
                           </a>
                        @endif
                        <button data-modal-hide="detail-modal-{{ $pemesanan->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
