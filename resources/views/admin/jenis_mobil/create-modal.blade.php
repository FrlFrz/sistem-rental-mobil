<div id="create-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-50 items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6 z-[10001]">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Tambah Mobil Baru </h3>

                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('jenis_mobil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2">
                        <label for="merek" class="block mb-2.5 text-sm font-medium text-gray-300">Merek</label>
                        <input type="text" name="merek" id="merek"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Avanza" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="tahun" class="block mb-2.5 text-sm font-medium text-gray-300">Tahun</label>
                        <input type="number" name="tahun" id="tahun" min="1990" max="{{ date('Y') }}" minlength="4" maxlength="4"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: 2020" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="kapasitas" class="block mb-2.5 text-sm font-medium text-gray-300">Kapasitas (+supir)</label>
                        <select id="kapasitas" name="kapasitas"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option disabled selected="">- Pilih Kapasitas -</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="foto_mobil" class="block mb-2.5 text-sm font-medium text-gray-300">Foto Mobil</label>
                        <input class="cursor-pointer block w-full text-sm text-gray-200 bg-gray-700 border border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 shadow-sm p-2.5 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700" aria-describedby="file_input_help" id="file_input" type="file" name="foto_mobil">
                        <p class="mt-1 text-sm text-gray-400" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 2MB).</p>

                        <div id="dropzone-area" class="mt-2 flex flex-col items-center justify-center w-full h-64 bg-gray-700 border-2 border-dashed border-gray-600 rounded-lg">
                            <img id="image-preview" src="#" alt="Preview Mobil" class="hidden w-full h-full object-cover rounded-lg p-2" />
                            <div id="default-content" class="flex flex-col items-center justify-center text-white pt-5 pb-6">
                                </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan Data') }}
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
    const fileInput = document.getElementById('file_input');
    const previewImage = document.getElementById('image-preview');
    const defaultContent = document.getElementById('default-content');

    fileInput.addEventListener('change', function(event) {
        // Pastikan ada file yang dipilih
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Tampilkan preview
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');

                // Sembunyikan konten default
                defaultContent.classList.add('hidden');
            }

            // Membaca file sebagai URL data
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
