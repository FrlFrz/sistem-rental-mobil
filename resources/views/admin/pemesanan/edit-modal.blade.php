@props(['pemesanan'])

<div id="edit-modal-{{ $pemesanan->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-xl max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Edit Pemesanan: {{ $pemesanan->id }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{ $pemesanan->id }}">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2 sm:col-span-1">
                        <label for="jenis_mobil_id-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Pilih Model</label>
                        <select id="jenis_mobil_id-{{ $pemesanan->id }}" required
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400">
                            <option value="" disabled selected>- Pilih Jenis Mobil -</option>
                            @foreach ($allJenisMobils as $jenis)
                                <option value="{{ $jenis->id_jenis_mobil }}"
                                    @if ($pemesanan->unitMobil->id_jenis_mobil == $jenis->id_jenis_mobil) selected @endif>
                                    {{ $jenis->merek }} ({{ $jenis->tahun }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="unit_mobil_id-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Pilih Unit (Plat Nomor)</label>
                        <select id="unit_mobil_id-{{ $pemesanan->id }}" name="id_unit_mobil" required disabled
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400">
                            <option value="" disabled selected>- Pilih Model Dahulu -</option>
                            </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Penyewa</label>
                        <input type="text" name="nama_penyewa" id="nama_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Sukma Dhika" required="" value="{{ old('nama_penyewa', $pemesanan->nama_penyewa) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nik_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">NIK</label>
                        <input type="text" name="nik_penyewa" id="nik_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 3505152006060002" required="" minlength="16" maxlength="18" value="{{ old('nik_penyewa', $pemesanan->nik_penyewa) }}">
                    </div>

                    <div class="col-span-2">
                        <label for="alamat_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Alamat</label>
                        <input type="textarea" name="alamat_penyewa" id="alamat_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Jl. Remaja RT 11 RW 08 Purwosari" required="" value="{{ old('alamat_penyewa', $pemesanan->alamat_penyewa) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="telepon_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">No. Telepon</label>
                        <input type="text" name="telepon_penyewa" id="telepon_penyewa-{{ $pemesanan->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 08578..." required="" minlength="11" maxlength="13" value="{{ old('telepon_penyewa', $pemesanan->telepon_penyewa) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="jaminan_penyewa-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Jaminan Penyewa</label>
                        <select id="jaminan_penyewa-{{ $pemesanan->id }}" name="jaminan_penyewa"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled selected="">- Pilih Jaminan -</option>
                            <option value="ktp" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "ktp")>KTP</option>
                            <option value="stnk" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "stnk")>STNK</option>
                            <option value="bpkb" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "bpkb")>BPKB</option>
                            <option value="sim" @selected(old('jaminan_penyewa', $pemesanan->jaminan_penyewa) == "sim")>SIM</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full group">
                                <label for="tgl_mulai-{{ $pemesanan->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="tgl_mulai-{{ $pemesanan->id }}"
                                        name="tgl_mulai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Pilih Tanggal Mulai"
                                        required value="{{ old('tgl_mulai', $pemesanan->tgl_mulai) }}"
                                    >
                                </div>
                                @error('tgl_mulai')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="durasi_rental-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Durasi Rental (hari)</label>
                                <div class="relative flex items-center max-w-[11rem] mt-1">
                                    <button type="button" id="decrement-button-{{ $pemesanan->id }}" data-input-counter-decrement="durasi_rental-{{ $pemesanan->id }}"
                                            class="bg-gray-700 border border-gray-600 text-gray-300
                                                hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-indigo-500
                                                font-medium text-sm px-3 focus:outline-none h-10 rounded-s-lg border-r-0">
                                        <svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>
                                    </button>

                                    <div class="relative w-full">
                                        <input type="text" id="durasi_rental-{{ $pemesanan->id }}" name="durasi_rental"
                                            data-input-counter data-input-counter-min="1" data-input-counter-max="7"
                                            class="border-x-0 h-10 text-white text-center w-full bg-gray-700 border border-gray-600
                                                    py-2.5 px-0 text-sm placeholder:text-gray-400 block"
                                            placeholder="1" value="{{ old('durasi_rental', $pemesanan->durasi_rental) }}" required />
                                    </div>

                                    <button type="button" id="increment-button-{{ $pemesanan->id }}" data-input-counter-increment="durasi_rental-{{ $pemesanan->id }}"
                                            class="bg-gray-700 border border-gray-600 text-gray-300
                                                hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-indigo-500
                                                font-medium leading-5 rounded-e-lg text-sm px-3 focus:outline-none h-10 border-l-0">
                                        <svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                                    </button>
                                </div>
                            </div>
                                <input type="hidden" id="tgl_selesai_hidden-{{ $pemesanan->id }}" name="tgl_selesai" value="{{ old('tgl_selesai', $pemesanan->tgl_selesai) }}">
                            </div>
                    </div>

                    <div class="col-span-2 sm:col-span-1 hidden">
                        <label class="block mb-2.5 text-sm font-medium text-gray-300">Harga / hari (Rp)</label>

                        <p class="text-white text-md font-semibold p-2.5 bg-gray-700 border border-gray-600 rounded-lg">
                            Rp <span id="harga_per_hari_span">0</span>
                        </p>

                        <input type="hidden" id="harga_rental_per_hari_hidden-{{ $pemesanan->id }}" name="harga_rental_per_hari" value="0">
                    </div>

                    <div class="col-span-2 mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-300">Total Harga Rental</label>
                        <p class="text-white text-lg font-bold">
                            Rp <span id="total_harga_span-{{ $pemesanan->id }}">{{ old('total_biaya', $pemesanan->total_biaya) }}</span>
                        </p>
                        <input type="hidden" name="total_biaya" id="total_biaya-{{ $pemesanan->id }}" value="{{ old('total_biaya', $pemesanan->total_biaya) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="status_pemesanan-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Status Pemesanan</label>
                        <select id="status_pemesanan-{{ $pemesanan->id }}" name="status_pemesanan"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option value="dipesan" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "dipesan")>Dipesan</option>
                            <option value="dirental" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "dirental")>Dirental</option>
                            <option value="selesai" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "selesai")>Selesai</option>
                            <option value="dibatalkan" @selected(old('status_pemesanan', $pemesanan->status_pemesanan) == "dibatalkan")>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="pembayaran-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Pembayaran</label>
                        <select id="pembayaran-{{ $pemesanan->id }}" name="pembayaran"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled>- Pilih Pembayaran -</option>
                            <option value="transfer_bank" @selected(old('pembayaran', $pemesanan->pembayaran) == "transfer_bank")>Transfer Bank</option>
                            <option value="qris"  @selected(old('pembayaran', $pemesanan->pembayaran) == "qris")>QRIS</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="bukti_pembayaran-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Foto Bukti Pembayaran</label>
                        <input class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white" aria-describedby="file_input_help" id="file_input_pembayaran-{{ $pemesanan->id }}" type="file" name="bukti_pembayaran">
                        @if ($pemesanan->bukti_pembayaran)
                            <p class="mt-1 text-sm text-gray-400" id="file_input_help">{{ $pemesanan->bukti_pembayaran }}</p>
                            <p class="mt-2 text-xs text-gray-400">Gambar saat ini ada. Unggah file baru untuk mengganti.</p>
                        @endif
                    </div>

                    <div class="col-span-2">
                        <label for="foto_ktp_sim-{{ $pemesanan->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Foto SIM / KTP (salah satu)</label>
                        <input class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white" aria-describedby="file_input_help" id="file_input-{{ $pemesanan->id }}" type="file" name="foto_ktp_sim">
                        <p class="mt-1 text-sm text-gray-400" id="file_input_help">PNG, JPG or JPEG (MAX. 2MB).</p>

                        @if ($pemesanan->foto_ktp_sim)
                            <p class="mt-2 text-xs text-gray-400">Gambar saat ini ada. Unggah file baru untuk mengganti.</p>

                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-36 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">

                                <img id="image-preview-{{ $pemesanan->id }}"
                                    src="{{ asset('storage/pemesanan/' . old('foto_ktp_sim', $pemesanan->foto_ktp_sim)) }}"
                                    alt="Preview KTP/SIM"
                                    class="w-full h-full object-cover rounded-lg p-2" />

                                <div id="default-content-{{ $pemesanan->id }}" class="hidden">
                                    </div>

                            </div>
                        @else
                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-36 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">
                                <img id="image-preview-{{ $pemesanan->id }}" src="#" alt="Preview KTP/SIM" class="hidden w-full h-full object-cover rounded-lg p-2" />
                                <div id="default-content-{{ $pemesanan->id }}" class="flex flex-col items-center justify-center text-white pt-5 pb-6">
                                    </div>
                            </div>
                        @endif
                    </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan') }}
                    </x-primary-button>

                    <button data-modal-hide="edit-modal-{{ $pemesanan->id }}" type="button"
                        class="text-gray-300 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    initModalEdit('{{ $pemesanan->id }}');

</script> --}}
