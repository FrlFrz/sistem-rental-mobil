<x-register-page-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nama Depan --}}
        <div>
            <x-input-label for="nama_depan" :value="__('Nama Depan')" />
            <x-text-input id="nama_depan" class="block mt-1 w-full" type="text" name="nama_depan" :value="old('nama_depan')" required autofocus />
            <x-input-error :messages="$errors->get('nama_depan')" class="mt-2" />
        </div>

        {{-- Nama Belakang --}}
        <div class="mt-4"z>
            <x-input-label for="nama_belakang" :value="__('Nama Belakang')" />
            <x-text-input id="nama_belakang" class="block mt-1 w-full" type="text" name="nama_belakang" :value="old('nama_belakang')" required autofocus />
            <x-input-error :messages="$errors->get('nama_belakang')" class="mt-2" />
        </div>

        <!-- Tanggal Lahir -->
        <div class="mt-4">
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required/>
            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                          class="block mt-1 w-full"
                          type="email"
                          name="email" :value="old('email')"
                          placeholder="example@example.com"
                          required autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password"
                              class="block mt-1 w-full pr-10"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />

                <!-- Tombol mata untuk Password -->
                <button type="button"
                        id="togglePassword"
                        data-target="password"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <!-- Ikon mata tertutup -->
                    <img id="eyeClosed-password"
                            src="https://www.svgrepo.com/show/521651/eye-off.svg"
                            alt="Hide password"
                            class="w-5 h-5 opacity-40">

                    <!-- Ikon mata terbuka -->
                    <img id="eyeOpen-password"
                            src="https://www.svgrepo.com/show/448763/eye-on.svg"
                            alt="Show password"
                            class="w-5 h-5 hidden">

                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation"
                                class="block mt-1 w-full pr-10"
                                type="password"
                                name="password_confirmation"
                                required autocomplete="new-password" />

                <!-- Tombol mata untuk Confirm Password (DUPLIKASI) -->
                <button type="button"
                        id="togglePasswordConfirmation"
                        data-target="password_confirmation"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <!-- Ikon mata tertutup -->
                    <img id="eyeClosed-password_confirmation"
                            src="https://www.svgrepo.com/show/521651/eye-off.svg"
                            alt="Hide password"
                            class="w-5 h-5 opacity-40">

                    <!-- Ikon mata terbuka -->
                    <img id="eyeOpen-password_confirmation"
                            src="https://www.svgrepo.com/show/448763/eye-on.svg"
                            alt="Show password"
                            class="w-5 h-5 hidden">
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Script toggle (MODIFIKASI UNTUK MENGELOLA KEDUA FIELD) -->
        <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Fungsi umum untuk mengelola toggle
            const setupPasswordToggle = (inputId, toggleId) => {
                const passwordInput = document.getElementById(inputId);
                const toggleButton = document.getElementById(toggleId);

                // Pengecekan keamanan: hanya jalankan jika elemen ditemukan
                if (!passwordInput || !toggleButton) {
                    return;
                }

                // Ambil ikon berdasarkan ID yang diubah
                const eyeOpen = document.getElementById('eyeOpen-' + inputId);
                const eyeClosed = document.getElementById('eyeClosed-' + inputId);


                toggleButton.addEventListener('click', () => {
                    const isHidden = passwordInput.type === 'password';
                    passwordInput.type = isHidden ? 'text' : 'password';

                    // Ganti ikon sesuai status
                    eyeOpen.classList.toggle('hidden', !isHidden);
                    eyeClosed.classList.toggle('hidden', isHidden);
                });
            };

            // Setup untuk field 'password'
            setupPasswordToggle('password', 'togglePassword');

            // Setup untuk field 'password_confirmation'
            setupPasswordToggle('password_confirmation', 'togglePasswordConfirmation');
        });
        </script>

        <div class="mt-8">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-[#357DFF] hover:text-[#ff3c3c] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>


    </form>
</x-register-page-layout>
