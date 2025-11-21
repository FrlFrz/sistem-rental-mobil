@props(['jenis_mobil'])

<div id="edit-modal-{{ $jenis_mobil->id_jenis_mobil }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Edit Jenis Mobil: {{ $jenis_mobil->merek }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{ $jenis_mobil->id_jenis_mobil }}">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('jenis_mobil.update', $jenis_mobil->id_jenis_mobil) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2">
                        <label for="merek-{{ $jenis_mobil->id_jenis_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Merek</label>
                        <input type="text" name="merek" id="merek-{{ $jenis_mobil->id_jenis_mobil }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: FrlFrz" required="" value="{{ old('merek', $jenis_mobil->merek) }}">
                            @error('merek')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="tahun-{{ $jenis_mobil->id_jenis_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Tahun</label>
                        <input type="number" name="tahun" id="tahun-{{ $jenis_mobil->id_jenis_mobil }}" min="1990" max="{{ date('Y') }}" minlength="4" maxlength="4"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 2020" required="" value="{{ old('tahun', $jenis_mobil->tahun) }}">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="kapasitas-{{ $jenis_mobil->id_jenis_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Kapasitas (+supir)</label>
                        <select id="kapasitas-{{ $jenis_mobil->id_jenis_mobil }}" name="kapasitas"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled>- Pilih Kapasitas -</option>
                            <option value="2" @selected(old('kapasitas', $jenis_mobil->kapasitas) == 2)>2</option>
                            <option value="4" @selected(old('kapasitas', $jenis_mobil->kapasitas) == 4)>4</option>
                            <option value="6" @selected(old('kapasitas', $jenis_mobil->kapasitas) == 6)>6</option>
                            <option value="8" @selected(old('kapasitas', $jenis_mobil->kapasitas) == 8)>8</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="harga_rental_per_hari-{{ $jenis_mobil->id_jenis_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Harga / hari (Rp)</label>
                        <input type="text" name="harga_rental_per_hari" id="harga_rental_per_hari-{{ $jenis_mobil->id_jenis_mobil }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 250000" required="" value="{{ old('harga_rental_per_hari', $jenis_mobil->harga_rental_per_hari) }}">
                    </div>

                    <div class="col-span-2">
                        <label for="foto_mobil-{{ $jenis_mobil->id_jenis_mobil }}" class="block mb-2.5 text-sm font-medium text-gray-300">Foto Mobil (Opsional)</label>

                        <input type="file" name="foto_mobil" id="foto_mobil-{{ $jenis_mobil->id_jenis_mobil }}"
                            class="block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 file:bg-indigo-600 file:text-white"
                            accept="image/*" onchange="previewImageEdit(this)">

                        @if ($jenis_mobil->foto_mobil)
                            <p class="mt-2 text-xs text-gray-400">Gambar saat ini ada. Unggah file baru untuk mengganti.</p>

                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-64 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">

                                <img id="image-preview-{{ $jenis_mobil->id_jenis_mobil }}"
                                    src="{{ asset('storage/jenis_mobil/' . old('foto_mobil', $jenis_mobil->foto_mobil)) }}"
                                    alt="Preview Mobil"
                                    class="w-full h-full object-cover rounded-lg p-2" />

                                <div id="default-content-{{ $jenis_mobil->id_jenis_mobil }}" class="hidden">
                                    </div>

                            </div>
                        @else
                            <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-64 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">
                                <img id="image-preview-{{ $jenis_mobil->id_jenis_mobil }}" src="#" alt="Preview Mobil" class="hidden w-full h-full object-cover rounded-lg p-2" />
                                <div id="default-content-{{ $jenis_mobil->id_jenis_mobil }}" class="flex flex-col items-center justify-center text-white pt-5 pb-6">
                                    </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                    <button data-modal-hide="edit-modal-{{ $jenis_mobil->id_jenis_mobil }}" type="button"
                        class="text-white bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImageEdit(inputElement) {
        const elementId = inputElement.id;
        const userId = elementId.split('-').pop();

        const previewImage = document.getElementById(`image-preview-${userId}`);
        const defaultContent = document.getElementById(`default-content-${userId}`);

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
    }
</script>
