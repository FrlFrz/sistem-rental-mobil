@props(['user'])

<div id="edit-modal-{{ $user->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 max-h-full">

    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-gray-800 border border-gray-700 rounded-lg shadow-2xl p-4 md:p-6">

            <div class="flex items-center justify-between border-b border-gray-700 pb-4 md:pb-5">
                <h3 class="text-xl font-medium text-white">
                    Edit Akun: {{ $user->name }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{ $user->id }}">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form action="{{ route('akun_user.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">

                    <div class="col-span-2">
                        <label for="name-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Username</label>
                        <input type="text" name="name" id="name-{{ $user->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: FrlFrz" required="" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_depan-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Depan</label>
                        <input type="text" name="nama_depan" id="nama_depan-{{ $user->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Fuad" required="" value="{{ old('nama_depan', $user->nama_depan) }}">
                            @error('nama_depan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_belakang-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Nama Belakang</label>
                        <input type="text" name="nama_belakang" id="nama_belakang-{{ $user->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: Brimantoro" required="" value="{{ old('nama_belakang', $user->nama_belakang) }}">
                            @error('nama_belakang')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="email-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Email</label>
                        <input type="email" name="email" id="email-{{ $user->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Contoh: atminhytam@gmail.com" required="" value="{{ old('nama_belakang', $user->email) }}" oninput="this.value = this.value.toLowerCase()">
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="roles-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Role</label>
                        <select id="roles-{{ $user->id }}" name="roles"
                            class="block w-full px-3 py-2.5 bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 placeholder:text-gray-400">
                            <option value="" disabled>- Pilih Role -</option>
                            <option value="admin" @selected(old('roles', $user->roles) == 'admin')>Admin</option>
                            <option value="user" @selected(old('roles', $user->roles) == 'user')>User</option>
                        </select>
                        @error('roles')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="tanggal_lahir-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir-{{ $user->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5"
                            required value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                        @error('tanggal_lahir')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label for="password-edit-{{ $user->id }}" class="block mb-2.5 text-sm font-medium text-gray-300">Password Baru (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" id="password-edit-{{ $user->id }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full px-3 py-2.5 placeholder:text-gray-400"
                            placeholder="Isi untuk reset password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="flex items-center space-x-4 border-t border-gray-700 pt-4 md:pt-6">
                    <button type="submit"
                        class="inline-flex items-center text-white !bg-indigo-600 hover:bg-indigo-700 border border-transparent focus:ring-4 focus:ring-indigo-500 shadow-sm font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Simpan Perubahan
                    </button>
                    <button data-modal-hide="edit-modal-{{ $user->id }}" type="button"
                        class="text-white bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-500 font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
