<div id="create-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 justify-center z-50 items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">

        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6 z-[10001]">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Tambah Akun Baru </h3>

                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('akun_user.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_depan" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Depan</label>
                        <input type="text" name="nama_depan" id="nama_depan"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Fuad" required="">
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_belakang" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="nama_belakang"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Brimantoro">
                    </div>

                    <div class="col-span-2">
                        <label for="email" class="block mb-2.5 text-sm font-medium text-gray-300">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: atminhytam@gmail.com" required="" oninput="this.value = this.value.toLowerCase()">
                    </div>

                    <div class="col-span-2">
                        <label for="roles" class="block mb-2.5 text-sm font-medium text-gray-300">Role</label>
                        <select id="roles" name="roles"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400" required>
                            <option disabled selected value="">- Pilih Role -</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="tanggal_lahir" class="block mb-2.5 text-sm font-medium text-gray-300">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="block mt-1 w-full" style="background-color: #2C3E50; color: white;" required>
                    </div>

                    <div class="col-span-2">
                        <label for="password" class="block mb-2.5 text-sm font-medium text-gray-300">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="" required="">
                    </div>

                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <x-primary-button>
                        {{ __('Simpan Akun') }}
                    </x-primary-button>

                    <button data-modal-hide="create-modal" type="button"
                        class="text-white bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
