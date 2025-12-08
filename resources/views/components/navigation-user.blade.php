<nav class="w-full py-4 bg-[rgb(245,249,253)] border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 flex justify-between items-center max-w-7xl">
            <a href="{{ route('welcome') }}" class="text-gray-900 font-extrabold tracking-widest">
                <x-application-logo class="w-9 h-10"/>
            </a>

            <div>
                <div class="flex items-center">

                    @auth
                        {{-- Pengguna TELAH login (User atau Admin) --}}

                        {{-- Dropdown Menu (Menggunakan Tampilan Avatar dan Dark Mode/Abu-abu) --}}
                        <div class="relative inline-block text-left group">
                            {{-- Button pemicu diubah menjadi ikon/avatar --}}
                            <button
                                id="user-menu-button"
                                data-dropdown-toggle="user-dropdown"
                                type="button"
                                class="inline-flex items-center p-1 rounded-full text-sm font-bold tracking-wide transition duration-300 focus:outline-none focus:ring-2 focus:ring-[#ffa602]"
                                aria-expanded="false"
                                data-dropdown-placement="bottom-end"
                            >
                                {{-- Ganti dengan Avatar Pengguna --}}
                                <img
                                    class="w-10 h-10 rounded-full border-2 border-gray-300 hover:border-[#ffa602] transition duration-300"
                                    src="{{ asset('images/ANONYMOUS USER PROFILE.jpg') }}"
                                    alt="Avatar Pengguna"
                                >
                            </button>

                            {{-- Dropdown content --}}
                            <div
                                id="user-dropdown"
                                class="z-50 hidden absolute right-0 mt-2 w-72 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-2xl"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                            >
                                {{ $slot }}
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block font-bold tracking-wide px-5 py-2.5 bg-[#ffa602] text-gray-900 hover:text-white rounded-xl text-sm leading-none transition duration-300 shadow-md"
                        >
                            Log in &raquo;
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
