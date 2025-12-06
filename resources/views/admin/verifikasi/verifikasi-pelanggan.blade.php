{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <title>Verifikasi Pelanggan</title>
</head>
<body> --}}
<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            @if (session()->has('success'))
                <div id="alert-border-1" class="flex items-center p-4 mb-4 text-sm text-green-400 border-t-4 border-green-500 bg-gray-700 rounded-lg" role="alert">

                    {{-- SVG Icon untuk tanda centang / sukses --}}
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h4a1 1 0 0 1 0 2Zm1.713-3.693a1 1 0 0 1-1.42 1.42l-3-3a1 1 0 0 1 1.42-1.42l2.364 2.364Z"/>
                    </svg>

                    <div class="ms-3 text-sm font-medium">
                        <span class="font-bold">Berhasil!</span> {{ session()->get('success') }}
                    </div>

                    {{-- Tombol Tutup (Silang) --}}
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-700 text-green-400 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-gray-600 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-gray-800 shadow-xl rounded-lg p-6 text-center">

                <h2 class="text-2xl font-bold text-white mb-4">
                    Verifikasi QR Code
                </h2>

                <div id="reader" class="w-full max-w-sm mx-auto"></div>

                <div id="result" class="mt-4 p-3 bg-indigo-600 text-white font-semibold rounded-md">
                    Menunggu Scan...
                </div>

            </div>

        </div>
    </div>

    <div class="text-center">
        <h2 class="text-2xl font-bold text-white mb-4">Atau</h2>
    </div>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-xl rounded-lg p-6">

                    <label for="manual_token_input" class="block mb-2.5 text-sm font-medium text-gray-300">Token Verifikasi</label>
                        <input type="text" name="manual_token_input" id="manual_token_input"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="">

                   <div class="space-x-4 border-t border-gray-700 pt-4 md:pt-6 w-full">

                        <button type="button"
                            id="search_pemesanan_btn"
                            class="text-white !bg-indigo-600 hover:bg-indigo-700
                                focus:ring-4 focus:ring-indigo-500
                                shadow-md font-medium leading-5
                                rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                            Cari Pemesanan
                        </button>

                    </div>
                <div id="manual-feedback" class="mt-2 text-sm text-red-500"></div>
            </div>

        </div>
    </div>

    <div id="verifikasi-modal-container"></div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        let html5QrcodeScanner;

        // Fungsi baru untuk menutup modal dan mereload/merestart scanner
        function closeModalAndRestartScanner() {
            const modalContainer = document.getElementById('verifikasi-modal-container');
            modalContainer.innerHTML = ''; // Hapus modal dari DOM
            const feedbackEl = document.getElementById('manual-feedback');
            feedbackEl.textContent = ''; // Hapus feedback error manual jika ada

            if (typeof html5QrcodeScanner !== 'undefined') {
                window.location.reload();
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen yang sudah didefinisikan di HTML
            const searchButton = document.getElementById('search_pemesanan_btn');
            const tokenInput = document.getElementById('manual_token_input');
            const feedbackEl = document.getElementById('manual-feedback');

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader",
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    qrCodeProperties: {
                        tryHarder: true
                    },
                    // Opsional: Batasi resolusi yang masuk
                    videoConstraints: {
                        facingMode: { ideal: "environment" },
                        width: { ideal: 1920 },
                        height: { ideal: 1080 }
                    }
                }
            );

            if (searchButton && tokenInput) {
                searchButton.addEventListener('click', function() {
                    const manualToken = tokenInput.value.trim();

                    processVerificationToken(manualToken);
                });
            }

            function processVerificationToken(token) {
                try {
                    if (typeof html5QrcodeScanner !== 'undefined') {
                        // Cek status, 2 = SCANNING
                        if (html5QrcodeScanner.getState() === 2) {
                            html5QrcodeScanner.pause();
                        }
                    }
                } catch (e) {
                    console.warn("Scanner tidak dapat dihentikan, mungkin sudah di-clear.");
                }

                const modalContainer = document.getElementById('verifikasi-modal-container');
                modalContainer.innerHTML = `
                <div class="overflow-y-auto flex overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-40 items-center bg-gray-700 opacity-5 w-full md:inset-0 max-h-full" style="opacity: 0.8;">
                    <div>
                        <div role="status">
                            <svg aria-hidden="true"
                                class="inline w-10 h-10 animate-spin fill-indigo-500 text-gray-400"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">

                                {{-- Path 1: Latar Belakang Lingkaran --}}
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor"/>

                                {{-- Path 2: Bagian yang Berputar --}}
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.8710 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.8130 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.0830 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                `;

                fetch(`/api/verifikasi/detail/${token}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // console.log('sukses')
                            renderVerificationModal(data.pemesanan, modalContainer);
                        } else {
                            // console.log('gagal')
                            modalContainer.innerHTML = '';
                            feedbackEl.textContent = `Gagal: ${data.message}`;
                        }
                    })
                    .catch(error => {
                        modalContainer.innerHTML = ''; // Clear loading
                        feedbackEl.textContent = 'Kesalahan Server saat mengambil data.';
                        console.error('Fetch Error:', error);
                    });
            }

            // --- 4. Modifikasi onScanSuccess ---
            // Pastikan onScanSuccess memanggil fungsi baru ini.
            function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear(); // Hentikan scanner dan clear view
                processVerificationToken(decodedText);
            }
        html5QrcodeScanner.render(onScanSuccess);
        });


        function renderVerificationModal(pemesananData, containerEl) {
            const unit = pemesananData.unit_mobil;
            const jenis = unit.jenis_mobil;
            const storageBasePath = "{{ asset('storage/pemesanan') }}";
            const storageBasePath2 = "{{ asset('storage/bukti_pembayaran') }}";
            const formatRupiahEdit = (angka) => {
                return new Intl.NumberFormat('id-ID').format(angka);
            }
            const statusPemesanan = pemesananData.status_pemesanan;
            if(statusPemesanan == 'dipesan') {
                actionUrl = `/pemesanan/konfirmasi/${pemesananData.id}`;
                buttonLabel = 'Konfirmasi Serah Terima';
            } else if(statusPemesanan == 'dirental') {
                actionUrl = `/pemesanan/pengembalian/${pemesananData.id}`;
                buttonLabel = 'Konfirmasi Pengembalian';
            }

            if(statusPemesanan == 'selesai' || statusPemesanan == 'dibatalkan') {
                const modalGagal = `
                <div id="modal-backdrop-overlay"
                class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-40 items-center bg-gray-700 opacity-5 w-full md:inset-0 max-h-full" style="opacity: 0.8;">
            </div>
            </div>
                <div id="verifikasi-modal" tabindex="-1" class="fixed inset-0 z-[10001] bg-black/50 flex justify-center items-center">
                    <div class="relative w-full max-w-lg">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-2xl">
                            <h3 class="text-xl font-bold text-red-500">Verifikasi Gagal</h3>

                            <div class="mt-4 space-y-2 dark:text-white">
                                <p><strong>Plat Nomor:</strong> ${unit.plat_nomor}</p>
                                <p><strong>Merek (Warna):</strong> ${jenis.merek} (${unit.warna})</p>
                                <p><strong>Penyewa:</strong> ${pemesananData.nama_penyewa}</p>
                            </div>
                            <p class="text-green-500 text-lg font-bold">
                                Perentalan ini dengan ID ${pemesananData.id} telah <span class="text-red-500">${statusPemesanan}</span.</span>
                            </p>

                            <button data-modal-hide="verifikasi-modal" type="button" onclick="closeModalAndRestartScanner()" class="mt-3 text-gray-500">Batal/Tutup</button>
                        </div>
                    </div>
                </div>
            `;
                containerEl.innerHTML = modalGagal;
            } else {
                const modalHTML = `

            <div id="modal-backdrop-overlay"
                class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-40 items-center bg-gray-700 opacity-5 w-full md:inset-0 max-h-full" style="opacity: 0.8;">
            </div>
            </div>
                <div id="verifikasi-modal" tabindex="-1" class="fixed inset-0 z-[10001] bg-black/50 flex justify-center items-start p-4 overflow-y-auto">
                    <div class="relative w-full max-w-lg my-8">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-2xl overflow-y-auto">
                            <h3 class="text-xl font-bold text-green-500">Verifikasi Berhasil!</h3>

                            <div class="mt-4 space-y-2 dark:text-white">
                                <p><strong>Plat Nomor:</strong> ${unit.plat_nomor}</p>
                                <p><strong>Merek (Warna):</strong> ${jenis.merek} (${unit.warna})</p>
                                <p><strong>Penyewa:</strong> ${pemesananData.nama_penyewa}</p>
                                <p><strong>Jaminan:</strong> ${pemesananData.jaminan_penyewa.toUpperCase()}</p>
                                <p><strong>Durasi:</strong> ${pemesananData.durasi_rental} hari</p>
                                <p><strong>Mulai/Selesai:</strong> ${pemesananData.tgl_mulai} hingga ${pemesananData.tgl_selesai}</p>
                                <p><strong>KTP/SIM:</strong></p>
                                <img src="${storageBasePath}/${pemesananData.foto_ktp_sim}" alt="Foto Dokumen Jaminan" class="rounded-lg mt-2 w-full h-48 object-cover border border-gray-600"/>
                                <p><strong>Bukti Pembayarn:</strong></p>
                                <img src="${storageBasePath2}/${pemesananData.bukti_pembayaran}" alt="Foto Dokumen Jaminan" class="rounded-lg mt-2 w-full h-48 object-cover border border-gray-600"/>
                                <p class="text-white text-lg font-bold">
                                    Rp <span class="text-green-500">${formatRupiahEdit(pemesananData.total_biaya)}</span>
                                </p>
                            </div>

                            <form action="${actionUrl}" method="POST" class="mt-6">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-lg w-full hover:bg-indigo-700 transition">
                                    ${buttonLabel}
                                </button>
                            </form>

                            <button data-modal-hide="verifikasi-modal" type="button" onclick="closeModalAndRestartScanner()" class="mt-3 text-gray-500 w-full hover:text-gray-700 transition">Batal/Tutup</button>
                        </div>
                    </div>
                </div>
            `;
                containerEl.innerHTML = modalHTML;
            }

        }
        </script>
    </x-app-layout>
{{-- </body>
</html> --}}
