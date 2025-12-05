<x-app-layout>

    <script>
        function initModalEdit(pemesananId, selectedUnitId, allUnitsData) {
            const availableUnits = allUnitsData;
            const selectedUnitIdOld = selectedUnitId;
            const jenisMobilSelectEdit = document.getElementById('jenis_mobil_id-' + pemesananId);
            const unitMobilSelectEdit = document.getElementById('unit_mobil_id-' + pemesananId);

            if (jenisMobilSelectEdit && jenisMobilSelectEdit.value) {
                // Memastikan nilai awal sudah terbaca (misalnya '8')
                jenisMobilSelectEdit.dispatchEvent(new Event('change'));
            }
            jenisMobilSelectEdit.addEventListener('change', function() {
                const selectedJenisId = this.value;

                unitMobilSelectEdit.innerHTML = '<option value="" disabled selected>Memuat Unit...</option>';
                unitMobilSelectEdit.disabled = true;

                if (!selectedJenisId) return;

                const filteredUnits = availableUnits.filter(unit => {
                    return String(unit.id_jenis_mobil) === selectedJenisId;
                });


                if (filteredUnits.length > 0) {
                    unitMobilSelectEdit.innerHTML = '<option value="" disabled selected>Pilih </option>';

                    filteredUnits.forEach(unit => {
                        const option = document.createElement('option');
                        option.value = unit.id_unit_mobil;
                        const warna = unit.warna ? ` (${unit.warna})` : '';
                        option.textContent = unit.plat_nomor + warna;

                        if (String(unit.id_unit_mobil) === selectedUnitIdOld) {
                            option.selected = true;
                        }

                        // console.log(unit.plat_nomor);

                        unitMobilSelectEdit.appendChild(option);
                    });
                    // console.log(selectedUnitId);
                    unitMobilSelectEdit.disabled = false;

                } else {
                    unitMobilSelectEdit.innerHTML = '<option value="" disabled selected>Tidak Ada Unit Tersedia</option>';
                }
            });

            if (jenisMobilSelectEdit.value) {
                jenisMobilSelectEdit.dispatchEvent(new Event('change'));
            }

            const fileInputEdit = document.getElementById('file_input-' + pemesananId);
            if (fileInputEdit) {
            fileInputEdit.addEventListener('change', function(event) {

                // Logika previewImageEdit() Anda di sini:
                const inputElement = event.target;
                const previewImage = document.getElementById(`image-preview-${pemesananId}`);
                const defaultContent = document.getElementById(`default-content-${pemesananId}`);

                if (inputElement.files && inputElement.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        if (defaultContent) {
                            defaultContent.classList.add('hidden');
                        }
                    }
                    reader.readAsDataURL(inputElement.files[0]);
                }
            });
        }



            // Anda bisa menempatkan kode ini di file JS utama atau di dalam tag <script> di View
            const tglMulaiElEdit = document.getElementById('tgl_mulai-' + pemesananId);
            const durasiRentalElEdit = document.getElementById('durasi_rental-' + pemesananId);
            const decrementBtnEdit = document.getElementById('decrement-button-' + pemesananId);
            const incrementBtnEdit = document.getElementById('increment-button-' + pemesananId);
            const tglSelesaiHiddenElEdit = document.getElementById('tgl_selesai_hidden-' + pemesananId);


            document.addEventListener('DOMContentLoaded', function() {
                const tglMulaiElEdit = document.getElementById('tgl_mulai-' + pemesananId);

                if (tglMulaiElEdit && typeof Datepicker !== 'undefined') {
                    new Datepicker(tglMulaiElEdit, {
                        autohide: true,
                        format: 'yyyy-mm-dd'
                    });
                }
            });

            function calculateEndDate() {
                const tglMulaiValue = tglMulaiElEdit.value;
                const durasiValue = parseInt(durasiRentalElEdit.value);

                // console.log(tglMulaiValue);
                // console.log(durasiValue);

                if (!tglMulaiValue || isNaN(durasiValue)) {
                    tglSelesaiHiddenElEdit.value = '';
                    return;
                }

                const parts = tglMulaiValue.split('-');
                if (parts.length !== 3) return;
                // console.log(parts);
                const startDate = new Date(parts[0], parseInt(parts[1]) - 1, parts[2]);

                startDate.setDate(startDate.getDate() + durasiValue);

                // console.log(startDate)

                const endDate = new Date(startDate);

                const pad = (num) => (num < 10 ? '0' : '') + num;

                const month = endDate.getMonth();

                const formattedMonth = pad(month + 1);

                const formattedEndDate = `${endDate.getFullYear()}-${formattedMonth}-${pad(endDate.getDate())}`;

                // console.log(formattedEndDate);

                // 4. Update Input Tersembunyi
                tglSelesaiHiddenElEdit.value = formattedEndDate;

                // console.log(`Rental Selesai pada: ${formattedEndDate}`);
            }

            tglMulaiElEdit.addEventListener('change', calculateEndDate);
            durasiRentalElEdit.addEventListener('change', calculateEndDate);
            decrementBtnEdit.addEventListener('click', function() {
                setTimeout(calculateEndDate, 0)
            });
            incrementBtnEdit.addEventListener('click', function() {
                setTimeout(calculateEndDate, 0)
            });
            tglMulaiElEdit.addEventListener('changeDate', calculateEndDate);
            calculateEndDate();



            // --- Elemen DOM ---
            const hargaPerHariSpanEdit = document.getElementById('harga_per_hari_span');
            const hargaPerHariHiddenEdit = document.getElementById('harga_rental_per_hari_hidden-' + pemesananId);
            const totalHargaSpanEdit = document.getElementById('total_harga_span-' + pemesananId);
            const totalHargaElEdit = document.getElementById('total_biaya-' + pemesananId);

            const unitJenisEdit = @json($cascadingDataEdit);
            // console.log(cascadingDataEditEdit)

            const formatRupiahEdit = (angka) => {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            if (totalHargaElEdit && totalHargaSpanEdit) {
                const nilaiLama = parseFloat(totalHargaElEdit.value) || 0; // Ambil nilai lama dan konversi
                totalHargaSpanEdit.textContent = formatRupiahEdit(nilaiLama);
            }

            function calculateTotalHarga() {
                const selectedUnitId = unitMobilSelectEdit.value;
                const durasiValue = parseInt(durasiRentalElEdit.value);

                const selectedUnit = availableUnits.find(unit => String(unit.id_unit_mobil) === selectedUnitId);

                // console.log(selectedUnit)

                let hargaPerHari = 0;

                if (selectedUnit && selectedUnit.jenis_mobil) {
                    hargaPerHari = selectedUnit.jenis_mobil.harga_rental_per_hari;
                }

                hargaPerHariSpanEdit.textContent = formatRupiahEdit(hargaPerHari);
                hargaPerHariHiddenEdit.value = hargaPerHari;

                let totalHarga = 0;
                if (hargaPerHari > 0 && !isNaN(durasiValue) && durasiValue > 0) {
                    totalHarga = hargaPerHari * durasiValue;
                }

                totalHargaSpanEdit.textContent = formatRupiahEdit(totalHarga);
                totalHargaElEdit.value = totalHarga;
            }

            decrementBtnEdit.addEventListener('click', function() {
                setTimeout(calculateTotalHarga, 0)
            });
            incrementBtnEdit.addEventListener('click', function() {
                setTimeout(calculateTotalHarga, 0)
            });
            unitMobilSelectEdit.addEventListener('change', calculateTotalHarga);
            durasiRentalElEdit.addEventListener('change', calculateTotalHarga);

        }


        function initModalCreate() {
            const unitTersedia = @json($unitTersediaCreate);

            const jenisMobilSelect = document.getElementById('jenis_mobil_id');
            const unitMobilSelect = document.getElementById('unit_mobil_id');

            jenisMobilSelect.addEventListener('change', function() {
                const selectedJenisId = this.value;

                unitMobilSelect.innerHTML = '<option value="" disabled selected>Memuat Unit...</option>';
                unitMobilSelect.disabled = true;

                if (!selectedJenisId) return;

                const filteredUnits = unitTersedia.filter(unit => {
                    return String(unit.id_jenis_mobil) === selectedJenisId;
                });

                if (filteredUnits.length > 0) {
                    unitMobilSelect.innerHTML = '<option value="" disabled selected>Pilih Unit</option>';
                    filteredUnits.forEach(unit => {
                        const option = document.createElement('option');
                        option.value = unit.id_unit_mobil;
                        const warna = unit.warna ? ` (${unit.warna})` : ''; // Cek jika data warna ada
                        option.textContent = unit.plat_nomor + warna;
                        unitMobilSelect.appendChild(option);
                    });
                    unitMobilSelect.disabled = false;
                } else {
                    unitMobilSelect.innerHTML = '<option value="" disabled selected>Tidak Ada Unit Tersedia</option>';
                }
            });

            // Jalankan event 'change' saat halaman dimuat jika ada nilai old()
            if (jenisMobilSelect.value) {
                jenisMobilSelect.dispatchEvent(new Event('change'));
            }



            const fileInput = document.getElementById('file_input');
            const previewImage = document.getElementById('image-preview');
            const defaultContent = document.getElementById('default-content');

            fileInput.addEventListener('change', function(event) {
                // Pastikan ada file yang dipilih
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {

                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');

                        defaultContent.classList.add('hidden');
                    }

                    reader.readAsDataURL(event.target.files[0]);
                }
            });



            // Anda bisa menempatkan kode ini di file JS utama atau di dalam tag <script> di View
            const tglMulaiEl = document.getElementById('tgl_mulai');
            const durasiRentalEl = document.getElementById('durasi_rental');
            const decrementBtn = document.getElementById('decrement-button');
            const incrementBtn = document.getElementById('increment-button');
            const tglSelesaiHiddenEl = document.getElementById('tgl_selesai_hidden');


            document.addEventListener('DOMContentLoaded', function() {
                const tglMulaiEl = document.getElementById('tgl_mulai');

                if (tglMulaiEl && typeof Datepicker !== 'undefined') {
                    new Datepicker(tglMulaiEl, {
                        autohide: true,
                        format: 'yyyy-mm-dd'
                    });
                }
            });

            function calculateEndDate() {
                const tglMulaiValue = tglMulaiEl.value;
                const durasiValue = parseInt(durasiRentalEl.value);

                // console.log(tglMulaiValue);
                // console.log(durasiValue);

                if (!tglMulaiValue || isNaN(durasiValue)) {
                    tglSelesaiHiddenEl.value = '';
                    return;
                }

                const parts = tglMulaiValue.split('-');
                if (parts.length !== 3) return;
                console.log(parts);
                const startDate = new Date(parts[0], parseInt(parts[1]) - 1, parts[2]);

                startDate.setDate(startDate.getDate() + durasiValue);

                const endDate = new Date(startDate);
                const pad = (num) => (num < 10 ? '0' : '') + num;
                const month = endDate.getMonth();
                const formattedMonth = pad(month + 1);
                const formattedEndDate = `${endDate.getFullYear()}-${formattedMonth}-${pad(endDate.getDate())}`;

                tglSelesaiHiddenEl.value = formattedEndDate;

            }

            tglMulaiEl.addEventListener('change', calculateEndDate);
            decrementBtn.addEventListener('click', function() {
                setTimeout(calculateEndDate, 0)
            });
            incrementBtn.addEventListener('click', function() {
                setTimeout(calculateEndDate, 0)
            });
            durasiRentalEl.addEventListener('change', calculateEndDate);
            tglMulaiEl.addEventListener('changeDate', calculateEndDate);
            calculateEndDate();



            // --- Elemen DOM ---
            const hargaPerHariSpan = document.getElementById('harga_per_hari_span');
            const hargaPerHariHidden = document.getElementById('harga_rental_per_hari_hidden');
            const totalHargaSpan = document.getElementById('total_harga_span');
            const totalHargaEl = document.getElementById('total_biaya');

            const unitJenis = @json($cascadingDataEdit);
            // console.log(unitJenis)

            const formatRupiah = (angka) => {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            function calculateTotalHarga() {
                const selectedUnitId = unitMobilSelect.value;
                const durasiValue = parseInt(durasiRentalEl.value);

                const selectedUnit = unitTersedia.find(unit => String(unit.id_unit_mobil) === selectedUnitId);

                // console.log(selectedUnit)

                let hargaPerHari = 0;

                if (selectedUnit && selectedUnit.jenis_mobil) {
                    hargaPerHari = selectedUnit.jenis_mobil.harga_rental_per_hari;
                }

                hargaPerHariSpan.textContent = formatRupiah(hargaPerHari);
                hargaPerHariHidden.value = hargaPerHari;

                let totalHarga = 0;
                if (hargaPerHari > 0 && !isNaN(durasiValue) && durasiValue > 0) {
                    totalHarga = hargaPerHari * durasiValue;
                }

                totalHargaSpan.textContent = formatRupiah(totalHarga);
                totalHargaEl.value = totalHarga;
            }

            decrementBtn.addEventListener('click', function() {
                setTimeout(calculateTotalHarga, 0)
            });
            incrementBtn.addEventListener('click', function() {
                setTimeout(calculateTotalHarga, 0)
            });
            unitMobilSelect.addEventListener('change', calculateTotalHarga);
            durasiRentalEl.addEventListener('change', calculateTotalHarga);
        }

        function initModalPreview(total, id) {
            const prevTotalBiaya = document.getElementById('prev_total_biaya-' + id);

            const formatRupiah = (angka) => {
                return new Intl.NumberFormat('id-ID').format(angka);
            }
            prevTotalBiaya.textContent = 'Rp. ' + formatRupiah(total)

        }
    </script>

    <div class="py-12">
        <div class="rounded-lg p-6">
            <div class="sm:ml-64 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-10">
                    <p class="text-4xl font-semibold dark:text-white">Daftar Pemesanan</p>
                    <x-secondary-button data-modal-target="create-modal" data-modal-toggle="create-modal">+ Tambah Pemesanan Baru</x-secondary-button>
                </div>
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

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="search-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID Pemesanan</th>
                                <th scope="col" class="px-6 py-3">Token Verifikasi</th>
                                <th scope="col" class="px-6 py-3">Unit Mobil</th>
                                <th scope="col" class="px-6 py-3">Tanggal (Mulai/Selesai)</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $pemesanan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pemesanan->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('pemesanan.qr.konversi', ['token' => $pemesanan->verification_token, 'return_to' => url()->current()]) }}" class="font-medium text-green-600 dark:text-green-500 hover:text-green-400 p-1.5 rounded-full inline-flex items-center" title="Download QR Code">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75v-2.25M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                        </svg>
                                    </a>{{ $pemesanan->verification_token }}</td>
                                <td class="px-6 py-4">{{ $pemesanan->unitMobil->jenis_mobil->merek }} [{{ $pemesanan->unitMobil->plat_nomor }}]</td>
                                <td class="px-6 py-4">{{ $pemesanan->tgl_mulai }} / {{ $pemesanan->tgl_selesai }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($pemesanan->status_pemesanan == 'dipesan') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-300
                                    @elseif($pemesanan->status_pemesanan == 'dirental') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-300
                                    @elseif($pemesanan->status_pemesanan == 'selesai') bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-300
                                    @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-300
                                    @endif">
                                        {{ ucfirst($pemesanan->status_pemesanan) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button data-modal-target="preview-modal-{{ $pemesanan->id }}" data-modal-toggle="preview-modal-{{ $pemesanan->id }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">Detail</button>
                                    <button data-modal-target="edit-modal-{{ $pemesanan->id }}" data-modal-toggle="edit-modal-{{ $pemesanan->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>

                                    <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" id="delete-form-{{ $pemesanan->id }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('delete-form-{{ $pemesanan->id }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @include('admin.pemesanan.preview-modal',['pemesanan' => $pemesanan])
                            @include('admin.pemesanan.edit-modal',['pemesanan' => $pemesanan])

                            <script>

                                initModalEdit(
                                    '{{ $pemesanan->id }}',                 // 1. pemesananId
                                    '{{ $pemesanan->id_unit_mobil }}',
                                    @json($cascadingDataEdit[$pemesanan->id])
                                );

                                initModalPreview('{{ $pemesanan->total_biaya }}', '{{ $pemesanan->id }}');
                            </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
@include('admin.pemesanan.create-modal')
<script>

    initModalCreate();
    // Datatables Init
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    }

        function confirmDelete(formId) {
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Anda akan menghapus data ini secara permanen dan tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",

            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                form.submit();
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
    }



</script>
