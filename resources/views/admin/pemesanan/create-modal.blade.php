<div id="create-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-50 items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-xl max-h-full">

        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6 z-[10001]">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Tambah Pemesanan Baru </h3>

                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2 sm:col-span-1">
                        <label for="jenis_mobil_id" class="block mb-2.5 text-sm font-medium text-gray-300">Pilih Model</label>
                        <select id="jenis_mobil_id" required
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400">
                            <option value="" disabled selected>- Pilih Jenis Mobil -</option>
                            @foreach ($allJenisMobils as $jenis)
                                <option value="{{ $jenis->id_jenis_mobil }}">
                                    {{ $jenis->merek }} ({{ $jenis->tahun }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="unit_mobil_id" class="block mb-2.5 text-sm font-medium text-gray-300">Pilih Unit (Plat Nomor)</label>
                        <select id="unit_mobil_id" name="id_unit_mobil" required disabled
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400">
                            <option value="" disabled selected>- Pilih Model Dahulu -</option>
                            </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_penyewa" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" id="nama_penyewa"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Sukma Dhika" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nik_penyewa" class="block mb-2.5 text-sm font-medium text-gray-300">NIK</label>
                        <input type="text" name="nik_penyewa" id="nik_penyewa"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 3505152006060002" required="" minlength="16" maxlength="16">
                    </div>

                    <div class="col-span-2">
                        <label for="alamat_penyewa" class="block mb-2.5 text-sm font-medium text-gray-300">Alamat</label>
                        <input type="textarea" name="alamat_penyewa" id="alamat_penyewa"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Jl. Remaja RT 11 RW 08 Purwosari" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="telepon_penyewa" class="block mb-2.5 text-sm font-medium text-gray-300">No. Telepon</label>
                        <input type="text" name="telepon_penyewa" id="telepon_penyewa"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 08578..." required="" minlength="11" maxlength="13">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="jaminan_penyewa" class="block mb-2.5 text-sm font-medium text-gray-300">Jaminan Penyewa</label>
                        <select id="jaminan_penyewa" name="jaminan_penyewa"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled selected="">- Pilih Jaminan -</option>
                            <option value="ktp">KTP</option>
                            <option value="stnk">STNK</option>
                            <option value="bpkb">BPKB</option>
                            <option value="sim">SIM</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full group">
                                <label for="tgl_mulai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="tgl_mulai"
                                        name="tgl_mulai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Pilih Tanggal Mulai"
                                        required
                                    >
                                </div>
                                @error('tgl_mulai')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="durasi_rental" class="block mb-2.5 text-sm font-medium text-gray-300">Durasi Rental (hari)</label>
                                <div class="relative flex items-center max-w-[11rem] mt-1">
                                    <button type="button" id="decrement-button" data-input-counter-decrement="durasi_rental"
                                            class="bg-gray-700 border border-gray-600 text-gray-300
                                                hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-indigo-500
                                                font-medium text-sm px-3 focus:outline-none h-10 rounded-s-lg border-r-0">
                                        <svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>
                                    </button>

                                    <div class="relative w-full">
                                        <input type="text" id="durasi_rental" name="durasi_rental"
                                            data-input-counter data-input-counter-min="1" data-input-counter-max="7"
                                            class="border-x-0 h-10 text-white text-center w-full bg-gray-700 border border-gray-600
                                                    py-2.5 px-0 text-sm placeholder:text-gray-400 block"
                                            placeholder="1" value="1" required />
                                    </div>

                                    <button type="button" id="increment-button" data-input-counter-increment="durasi_rental"
                                            class="bg-gray-700 border border-gray-600 text-gray-300
                                                hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-indigo-500
                                                font-medium leading-5 rounded-e-lg text-sm px-3 focus:outline-none h-10 border-l-0">
                                        <svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                    </button>
                                </div>
                            </div>
                                <input type="hidden" id="tgl_selesai_hidden" name="tgl_selesai">
                            </div>

                    </div>

                    <div class="col-span-2 sm:col-span-1 hidden">
                        <label class="block mb-2.5 text-sm font-medium text-gray-300">Harga / hari (Rp)</label>

                        <p class="text-white text-md font-semibold p-2.5 bg-gray-700 border border-gray-600 rounded-lg">
                            Rp <span id="harga_per_hari_span">0</span>
                        </p>

                        <input type="hidden" id="harga_rental_per_hari_hidden" name="harga_rental_per_hari" value="0">
                    </div>

                    <div class="col-span-2 mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-300">Total Harga Rental</label>
                        <p class="text-white text-lg font-bold">
                            Rp <span id="total_harga_span">0</span>
                        </p>
                        <input type="hidden" name="total_biaya" id="total_biaya">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="status_pemesanan" class="block mb-2.5 text-sm font-medium text-gray-300">Status Pemesanan</label>
                        <select id="status_pemesanan" name="status_pemesanan"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option value="dipesan" selected>Dipesan</option>
                            <option value="dirental">Dirental</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="pembayaran" class="block mb-2.5 text-sm font-medium text-gray-300">Pembayaran</label>
                        <select id="pembayaran" name="pembayaran"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled selected="">- Pilih Pembayaran -</option>
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="bukti_pembayaran" class="block mb-2.5 text-sm font-medium text-gray-300">Foto Bukti Pembayaran</label>
                        <input class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white" aria-describedby="file_input_help" id="file_input_pembayaran" type="file" name="bukti_pembayaran">
                        <p class="mt-1 text-sm text-gray-400" id="file_input_help">PNG, JPG or JPEG (MAX. 2MB).</p>
                    </div>

                    <div class="col-span-2">
                        <label for="foto_ktp_sim" class="block mb-2.5 text-sm font-medium text-gray-300">Foto SIM / KTP (salah satu)</label>
                        <input class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white" aria-describedby="file_input_help" id="file_input" type="file" name="foto_ktp_sim">
                        <p class="mt-1 text-sm text-gray-400" id="file_input_help">PNG, JPG or JPEG (MAX. 2MB).</p>

                        <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-36 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">
                            <img id="image-preview" src="#" alt="Preview KTP/SIM" class="hidden w-full h-full object-cover rounded-lg p-2" />
                            <div id="default-content" class="flex flex-col items-center justify-center text-white pt-5 pb-6">
                                </div>
                        </div>
                    </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan') }}
                    </x-primary-button>

                    <button data-modal-hide="create-modal" type="button"
                        class="text-gray-300 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    // Jenis dan Unit Mobil Dinamis
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
            unitMobilSelect.innerHTML = '<option value="" disabled selected>Pilih Plat Nomor</option>';
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
        tglSelesaiHiddenEl.value = formattedEndDate;
    }

    tglMulaiEl.addEventListener('change', calculateEndDate);
    durasiRentalEl.addEventListener('change', calculateEndDate);

    tglMulaiEl.addEventListener('changeDate', calculateEndDate);
    calculateEndDate();



    // --- Elemen DOM ---
    const hargaPerHariSpan = document.getElementById('harga_per_hari_span');
    const hargaPerHariHidden = document.getElementById('harga_rental_per_hari_hidden');
    const totalHargaSpan = document.getElementById('total_harga_span');
    const totalHargaEl = document.getElementById('total_biaya');

    // Array data unit mobil yang dimuat dari PHP:
    const unitJenis = @json($cascadingDataEdit);
    console.log(unitTersedia)

    const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID').format(angka);
}

function calculateTotalHarga() {
    try {
        const selectedUnitId = unitMobilSelect.value;
        const durasiValue = parseInt(durasiRentalEl.value);

        console.log("Unit ID Terpilih:", selectedUnitId);
        console.log("Durasi (Hari):", durasiValue);

        // Jika tidak ada unit terpilih, set ke nol dan keluar.
        if (!selectedUnitId) {
            totalHargaSpan.textContent = formatRupiah(0);
            totalHargaEl.value = 0;
            return;
        }

        // 1. Cari data unit yang terpilih
        const selectedUnit = unitTersedia.find(unit => String(unit.id_unit_mobil) === selectedUnitId);
        // CATATAN: Pastikan Anda menggunakan properti ID yang benar (id atau id_unit_mobil)

        console.log("Data Unit Ditemukan:", selectedUnit);

        let hargaPerHari = 0;

        // 2. AKSES HARGA (Potensi error ada di sini)
        if (selectedUnit && selectedUnit.jenis_mobil) {
             // Pastikan nama relasi dan kolom harga benar (jenis_mobil)
             hargaPerHari = selectedUnit.jenis_mobil.harga_rental_per_hari;
        } else if (selectedUnit) {
             console.error("ERROR TERTANGKAP: Relasi 'jenis_mobil' pada unit ID", selectedUnitId, "kosong atau gagal di-load.");
        }

        // 3. PERHITUNGAN DAN UPDATE
        hargaPerHariSpan.textContent = formatRupiah(hargaPerHari);
        hargaPerHariHidden.value = hargaPerHari;

        let totalHarga = 0;
        if (hargaPerHari > 0 && !isNaN(durasiValue) && durasiValue > 0) {
            totalHarga = hargaPerHari * durasiValue;
        }

        totalHargaSpan.textContent = formatRupiah(totalHarga);
        totalHargaEl.value = totalHarga;

    } catch (e) {
        console.error("KRITIS: Gagal menghitung total harga. Error:", e.message, e);
        totalHargaSpan.textContent = "Error!";
    }
}

// Tambahkan Event Listener (Pastikan elemen sudah ada di atas)
unitMobilSelect.addEventListener('change', calculateTotalHarga);
durasiRentalEl.addEventListener('change', calculateTotalHarga);
</script>
