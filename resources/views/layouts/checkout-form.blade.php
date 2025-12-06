<x-page-style>

    {{-- <div class="container flex px-6 pt-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium  hover:text-[#ffa602] text-black">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium  hover:text-[#ffa602] md:ms-2 text-black">Katalog</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="#" class="ms-1 text-sm font-medium  hover:text-[#ffa602] md:ms-2 text-black">Keranjang</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium md:ms-2 text-gray-400">Checkout</span>
                </div>
            </li>
        </ol>
    </div> --}}

    <div class="container mx-auto px-6 py-10 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SIDE FORM -->

        <div class="lg:col-span-2 space-y-6">
        <form action="{{ route('pemesanan.store') }}" id="checkout-form" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Billing Address -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h2 class="text-2xl font-bold mb-4 uppercase">Checkout</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- @foreach ($availableUnits as $unit) --}}
                        <input type="hidden" name="redirect_to_histori" value="1">
                        {{-- <input type="hidden" name="id_unit_mobil" id="id_unit_mobil" value="{{ $availableUnits->id_unit_mobil }}"> --}}
                    {{-- @endforeach --}}
                    <div>
                        <label for="nama_penyewa" class="font-medium">Nama Lengkap*</label>
                        <input class="w-full border rounded-lg p-2 mt-1" name="nama_penyewa" id="nama_penyewa"
                                type="text"
                                minlength="3"
                                maxlength="100"
                                pattern="[A-Za-z\s']+"
                                required>
                    </div>

                    <div>
                        <label for="nik_penyewa" class="font-medium">NIK*</label>
                        <input class="w-full border rounded-lg p-2 mt-1" name="nik_penyewa" id="nik_penyewa"
                                type="tel"
                                maxlength="16" minlength="16"
                                pattern="[0-9]{16}"
                                inputmode="numeric"
                                required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat_penyewa" class="font-medium">Alamat Lengkap*</label>
                        <input class="w-full border rounded-lg p-2 mt-1" name="alamat_penyewa" id="alamat_penyewa"
                                type="text"
                                minlength="10"
                                maxlength="200"
                                required>
                    </div>

                    <div>
                        <label for="telepon_penyewa" class="font-medium">No. Telepon*</label>
                        <input class="w-full border rounded-lg p-2 mt-1" name="telepon_penyewa" id="telepon_penyewa"
                                type="tel"
                                minlength="10"
                                maxlength="13"
                                pattern="[0-9]+"
                                inputmode="numeric"
                                required>
                    </div>

                    <div>
                        <label for="jaminan_penyewa" class="font-medium">Jaminan Penyewa*</label>
                        <select class="w-full border rounded-lg p-2 mt-1" name="jaminan_penyewa" id="jaminan_penyewa">
                            <option value="" disabled selected hidden>- Pilih Jaminan -</option>
                            <option value="ktp">KTP</option>
                            <option value="ktm">KTM</option>
                            <option value="stnk">STNK</option>
                            <option value="sim">SIM</option>
                        </select>
                    </div>

                    <div>
                        <label for="tgl_mulai" class="font-medium">Tanggal Mulai*</label>
                        <input class="w-full border rounded-lg p-2 mt-1" type="date" name="tgl_mulai" id="tgl_mulai">
                    </div>

                    <div>
                        <label class="font-medium">Durasi Rental*</label>

                        <div class="relative flex items-center max-w-[11rem] shadow-xs rounded-base p-1">
                            <button type="button" id="decrement-button" data-input-counter-decrement="durasi_rental" class="rounded text-body bg-neutral-secondary-medium box-border border border-default-medium border-gray-500 hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-s-base text-sm px-3 focus:outline-none h-10">
                                <svg class="w-4 h-4 text-heading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>
                            </button>
                            <input type="text" id="durasi_rental" name="durasi_rental" data-input-counter data-input-counter-min="1" data-input-counter-max="7" aria-describedby="helper-text-explanation" class="border-x-0 h-10 placeholder:text-heading text-heading text-center w-full bg-neutral-secondary-medium border-default-medium py-2.5 placeholder:text-body block pb-6 text-xs" placeholder="" value="1" required />
                            <div class="absolute bottom-1 start-1/2 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-body-subtle space-x-1 rtl:space-x-reverse">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>
                                <span>Hari</span>
                            </div>
                            <button type="button" id="increment-button" data-input-counter-increment="durasi_rental" class="rounded text-body bg-neutral-secondary-medium box-border border border-default-medium border-gray-500 hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-s-base text-sm px-3 focus:outline-none h-10">
                                <svg class="w-4 h-4 text-heading" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                            </button>
                        </div>
                    </div>
                        <input type="hidden" name="total_biaya" id="total_biaya">
                      <input type="hidden" name="tgl_selesai" id="tgl_selesai">
                </div>

            <input type="hidden" name="status_pemesanan" id="status_pemesanan" value="dipesan">

            <!-- Warna Unit -->
            <div class="bg-white p-6 rounded-xl shadow mt-10">
                <h2 class="text-2xl font-bold mb-4 uppercase">Warna Unit</h2>
                <div class="space-y-3">

                    @foreach ($availableUnits as $unit)
                        <label class="flex items-start gap-2">
                            <input type="radio" name="id_unit_mobil" id="id_unit_mobil-{{ $unit->id_unit_mobil }}" value="{{ $unit->id_unit_mobil }}" checked>
                            {{ $unit->warna }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="bg-white p-6 rounded-xl shadow mt-10">
                <h2 class="text-2xl font-bold mb-4 uppercase">Pilihan Pembayaran</h2>
                <div class="space-y-4">

                    <label class="flex items-center gap-2">
                        <input type="radio" name="pembayaran" id="payment-bank" value="transfer_bank" checked onclick="togglePaymentDetails()">
                        Transfer Bank (Jatim, BRI, BCA, Mandiri)
                    </label>

                    <div id="payment-bank-details" class="pl-6 pt-2 space-y-3">

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK JATIM.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank Jatim</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK BRI.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank BRI</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK BCA.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank BCA</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>

                        <div class="p-3 shadow-md border rounded-lg flex flex-1 items-center space-x-2">
                            <img src="{{ asset('images/LOGO BANK MANDIRI.png') }}" alt="" class="w-24">
                            <div>
                                <p class="text-lg font-semibold">Bank Mandiri</p>
                                <p class="text-sm text-gray-600">No. Rek: 1122-3344-5566-7788 (a/n Carental)</p>
                            </div>
                        </div>
                    </div>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="pembayaran" id="payment-qris-radio" value="qris" onclick="togglePaymentDetails()">
                        Pembayaran melalui QRIS
                    </label>

                    <div id="payment-qris-details" class="hidden pl-6 pt-2">
                        <div class="w-48 h-48 border p-2 bg-white shadow-md rounded-lg">
                            <img src="#" alt="">
                        </div>
                    </div>

                </div>
            </div>

            {{-- Upload Bukti Pembayaran --}}
            <div id="payment-proof-section" class="bg-white p-6 rounded-xl shadow mt-10">
                <h2 class="text-2xl font-bold mb-4 uppercase">Upload Bukti Pembayaran</h2>
                <div class="space-y-4">
                    <p class="text-sm text-gray-600">Silakan unggah bukti transfer atau QRIS.</p>
                    <div>
                        <label class="font-medium block mb-1">Upload Bukti Pembayaran</label>
                        <input type="file" id="bukti-pembayaran" name="bukti_pembayaran" accept="image/*" class="w-full border rounded-lg p-2 mt-1">
                    </div>
                </div>
            </div>

            {{-- Upload Jaminan Peminjaman--}}
            <div id="payment-proof-section" class="bg-white p-6 rounded-xl shadow mt-10">
                <h2 class="text-2xl font-bold mb-4 uppercase">Upload KTP/SIM</h2>
                <div class="space-y-4">
                    <p class="text-sm text-gray-600">Silakan unggah foto KTP atau SIM (pilih salah satu).</p>
                    <div>
                        <label class="font-medium block mb-1">Upload KTP/SIM</label>
                        <input type="file" id="foto_ktp_sim" name="foto_ktp_sim" accept="image/*" class="w-full border rounded-lg p-2 mt-1">
                    </div>
                </div>
            </div>
            <!-- Delivery Address -->
            <div class="bg-white p-6 rounded-xl shadow mt-10">
                <h2 class="text-2xl font-bold mb-4 uppercase">Alamat Ambil</h2>
                <div class="space-y-3">
                    <div id="pickup-address-detail" class="pl-6 pt-1 text-gray-600 border-l border-gray-300 ml-2">
                        <p class="font-medium">Jl. Cakrawala No.5, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="sr-only hidden">Submit Form</button>
            </form>
        </div>
        </div>

        <!-- RIGHT SIDE ORDER SUMMARY -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-xl shadow space-y-4">
                <h2 class="text-2xl font-bold mb-2 uppercase">Order summary</h2>

                <div class="flex gap-4 border-b pb-4">
                    <div class="w-12 bg-gray-200 rounded">
                        <img src="{{ asset('storage/jenis_mobil/' . $jenis_mobil->foto_mobil) }}" alt="">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold">{{ $jenis_mobil->merek }}</p>
                        <p class="text-sm text-gray-600">Durasi sewa : <span id="durasi-display" class="text-gray-800">1</span> hari</p>
                    </div>
                    <span class="font-semibold">Rp. <span id="harga_rental_per_hari">{{ $jenis_mobil->harga_rental_per_hari }}</span> / hari</span>
                </div>

                <div class="text-sm space-y-1 pt-4">
                    <div class="flex justify-between"><span>Jumlah</span><span class="harga_rental_display">1</span></div>
                </div>

                <div class="flex justify-between font-bold text-lg border-t pt-4">
                    <span>Total</span>
                    <span class="total_biaya">1</span>
                </div>

                <button class="w-full bg-[#ffa602] text-black hover:text-white py-3 rounded-lg text-center font-semibold transition duration-300" onclick="triggerFormSubmit()">
                    Checkout
                </button>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script> --}}
    <script>

        const totalBiayaEl = document.querySelector('.total_biaya');
        let kirimHarga;

        function togglePaymentDetails() {
            const bankRadio = document.getElementById('payment-bank');
            const bankDetails = document.getElementById('payment-bank-details');
            const qrisDetails = document.getElementById('payment-qris-details');

            if (bankRadio.checked) {
                // Tampilkan detail bank
                bankDetails.classList.remove('hidden');
                qrisDetails.classList.add('hidden');
            } else {
                // Tampilkan detail QRIS
                bankDetails.classList.add('hidden');
                qrisDetails.classList.remove('hidden');
            }
        }

        // Panggil saat halaman dimuat untuk memastikan status awal
        document.addEventListener('DOMContentLoaded', togglePaymentDetails);

        const formatRupiah = (angka) => {
            new Intl.NumberFormat('id-ID').format(angka);
            const formattedNumber = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(Number(angka));

            return `${formattedNumber}`;
        }

        const decrementBtn = document.getElementById('decrement-button');
        const incrementBtn = document.getElementById('increment-button');

        const unitMobilSelect = document.querySelector('input[name="id_unit_mobil"]:checked');

        const durasiDisplaySpan = document.getElementById('durasi-display');
        const durasiInputEl = document.getElementById('durasi_rental');
        const biayaPerHariVal = document.querySelector('#harga_rental_per_hari').textContent;
        const biayaPerHariEl = document.querySelector('#harga_rental_per_hari');
        const jumlahRentalEl = document.querySelector('.harga_rental_display');
        const totalBiayaHidden = document.getElementById('total_biaya');

        // console.log(biayaPerHariVal)

        // document.addEventListener('DOMContentLoaded', function() {
        //     const uang = formatRupiah(biayaPerHariEl.textContent)
        //     biayaPerHariEl.innerHTML = uang;
        // })

        biayaPerHariEl.textContent = formatRupiah(biayaPerHariVal) + ',00';

        function calculateTotalHarga() {
            const selectedUnitId = unitMobilSelect.value;
            const durasiValue = parseInt(durasiInputEl.value);

            const uang = formatRupiah(biayaPerHariVal)

            let totalHarga = 0;
            if (uang > 0 && !isNaN(durasiValue) && durasiValue > 0) {
                totalHarga = biayaPerHariVal * durasiValue;
            }

            jumlahRentalEl.textContent = 'Rp. ' + formatRupiah(totalHarga) + ',00';
            durasiDisplaySpan.textContent = durasiValue;
            totalBiayaEl.textContent = 'Rp. ' + formatRupiah(totalHarga) + ',00';
            totalBiayaHidden.value = totalHarga;
        }

        calculateTotalHarga()

        decrementBtn.addEventListener('click', function() {
            setTimeout(calculateTotalHarga, 0)
        });
        incrementBtn.addEventListener('click', function() {
            setTimeout(calculateTotalHarga, 0)
        });

        // Tanggal Selesai
        const tglMulaiEl = document.getElementById('tgl_mulai');
        const tglSelesaiHiddenEl = document.getElementById('tgl_selesai');

        function calculateEndDate() {
            const tglMulaiValue = tglMulaiEl.value;
            const durasiValue = parseInt(durasiInputEl.value);

            if (!tglMulaiValue || isNaN(durasiValue)) {
                tglSelesaiHiddenEl.value = '';
                return;
            }

            const parts = tglMulaiValue.split('-');
            if (parts.length !== 3) return;

            const startDate = new Date(parts[0], parseInt(parts[1]) - 1, parts[2]);

            startDate.setDate(startDate.getDate() + durasiValue);

            const endDate = new Date(startDate);
            const pad = (num) => (num < 10 ? '0' : '') + num;
            const formattedMonth = pad(endDate.getMonth() + 1);
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
        durasiInputEl.addEventListener('change', calculateEndDate);
        tglMulaiEl.addEventListener('changeDate', calculateEndDate);
        calculateEndDate();

        function triggerFormSubmit() {
            const form = document.getElementById('checkout-form');

            if (form) {
                form.submit();
            } else {
                console.error("Formulir dengan ID 'checkout-form' tidak ditemukan.");
            }
        }

        const teleponInputEl = document.getElementById('telepon_penyewa');
        if (teleponInputEl) {
            teleponInputEl.addEventListener('input', function(e) {
                let value = e.target.value;
                // Hapus semua karakter non-angka
                value = value.replace(/[^0-9]/g, '');
                e.target.value = value;
            });
        }

        const NIKInput = document.getElementById('nik_penyewa');
        if (NIKInput) {
            NIKInput.addEventListener('input', function(e) {
                let value = e.target.value;
                value = value.replace(/[^0-9]/g, '');
                if (value.length > 16) {
                    value = value.substring(0, 16);
                }

                e.target.value = value;
            });
        }

    </script>

</x-page-style>
