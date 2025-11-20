@props(['unit_mobil'])

<div id="edit-modal-{{ $unit_mobil->id_unit_mobil }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-50 items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6 z-[10001]">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Edit Mobil : {{ $unit_mobil->jenis_mobil->merek }} [{{ $unit_mobil->plat_nomor }}]</h3>

                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{ $unit_mobil->id_unit_mobil }}">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('unit_mobil.update', $unit_mobil->id_unit_mobil) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2">
                        <label for="id_jenis_mobil-{{ $unit_mobil->id_unit_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Jenis Mobil</label>
                        <select id="id_jenis_mobil-{{ $unit_mobil->id_unit_mobil }}" name="id_jenis_mobil"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400" required>
                            <option disabled value="">- Pilih Jenis Mobil -</option>

                            @foreach($jenisMobils as $jenis)
                                <option
                                    value="{{ $jenis->id_jenis_mobil }}"
                                    {{
                                        $jenis->id_jenis_mobil == $unit_mobil->id_jenis_mobil ? 'selected' : ''
                                    }}
                                >
                                    {{ $jenis->merek }} ({{ $jenis->tahun }})
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="plat_nomor-{{ $unit_mobil->id_unit_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Plat Nomor</label>
                        <input type="text" name="plat_nomor" id="plat_nomor-{{ $unit_mobil->id_unit_mobil }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: AG 6279 OBY" required="" value="{{ old('plat_nomor', $unit_mobil->plat_nomor) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="warna-{{ $unit_mobil->id_unit_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Warna</label>
                        <input type="text" name="warna" id="warna-{{ $unit_mobil->id_unit_mobil }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Biru, Merah" required="" value="{{ old('warna', $unit_mobil->warna) }}">
                    </div>

                    <div class="col-span-2">
                        <label for="status_mobil-{{ $unit_mobil->id_unit_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Status Mobil</label>
                        <select id="status_mobil-{{ $unit_mobil->id_unit_mobil }}" name="status_mobil"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400" required>
                            <option value="tersedia" @selected(old('status_mobil', $unit_mobil->status_mobil) == 'tersedia')>Tersedia</option>
                            <option value="dipesan" @selected(old('status_mobil', $unit_mobil->status_mobil) == 'dipesan')>Dipesan</option>
                            <option value="dirental" @selected(old('status_mobil', $unit_mobil->status_mobil) == 'dirental')>Dirental</option>
                            <option value="perawatan" @selected(old('status_mobil', $unit_mobil->status_mobil) == 'perawatan')>Perawatan</option>
                        </select>
                    </div>

                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>

                    <button data-modal-hide="edit-modal-{{ $unit_mobil->id_unit_mobil }}" type="button"
                        class="text-white bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
