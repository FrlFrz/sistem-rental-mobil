<x-user-page-template>
    @section('title', 'Katalog')
        {{-- NAVBAR --}}
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
                                {{-- Bagian Info Pengguna (Nama & Email) --}}
                                <div class="px-4 py-4" role="none">
                                    <p class="text-lg font-extrabold text-gray-900 mb-1 leading-tight">
                                        {{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}
                                    </p>
                                    <p class="text-sm font-semibold text-[#ffa602]">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>

                                <div class="py-1" role="none">

                                    {{-- Opsi Khusus Admin: Tampil jika roles adalah 'admin' --}}
                                    @if (Auth::user()->roles === 'admin')
                                        <a href="{{ route('dashboard') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Dashboard Admin
                                        </a>
                                    @endif

                                    {{-- Opsi Umum (Profil Saya) --}}
                                    <a href="{{ url('user-profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                        <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Profil Saya
                                    </a>

                                    {{-- Opsi Umum (Histori Pemesanan) --}}
                                    <a href="{{ route('histori-pemesanan') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                        <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Histori Pemesanan
                                    </a>

                                    {{-- Opsi Umum (Keluar) --}}
                                    <form method="POST" action="{{ route('logout') }}" class="block w-full text-left" role="none">
                                        @csrf
                                        <button type="submit" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-red-500 hover:text-white transition duration-150 w-full">
                                            <svg class="w-5 h-5 mr-3 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-4a3 3 0 013-3h3m0-3V6a3 3 0 013-3h4a3 3 0 013 3v2"></path></svg>
                                            Keluar
                                        </button>
                                    </form>

                                </div>
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

    {{-- CONTENT --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-gray-500">
                <li><a href="{{ route("welcome") }}" class="hover:text-gray-900">Home</a></li>
                <li aria-current="page"><span class="mx-2">/</span><span class="text-gray-900">Katalog</span></li>
            </ol>
        </nav>

        <h1 class="text-2xl font-bold text-gray-900 mb-6">
            Katalog
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <aside class="lg:col-span-3">
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">

                    {{-- Search Bar --}}
                    <div id="accordion-search" data-accordion="collapse">
                        <h2 id="search-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left text-gray-900 !bg-transparent !text-gray-900 hover:text-blue-600 focus:outline-none focus:ring-0"
                                data-accordion-target="#search-body"
                                aria-expanded="true"
                                aria-controls="search-body">
                                Cari Mobil
                                <svg class="w-3 h-3 shrink-0 transition-transform duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="search-body" class="pt-2" aria-labelledby="search-heading">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                </div>
                                <input type="text" id="search-input"
                                    class="w-full pl-10 pr-4 py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="Cari merek mobil...">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Transmisi --}}
                    <div id="accordion-categories" data-accordion="collapse">
                        <h2 id="categories-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left text-gray-900 !bg-transparent !text-gray-900 hover:text-blue-600 focus:outline-none focus:ring-0 transition-colors duration-200"
                                data-accordion-target="#categories-body"
                                aria-expanded="false"
                                aria-controls="categories-body">
                                Transmisi
                                <svg class="w-3 h-3 shrink-0 transition-transform duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="categories-body" class="hidden pt-2" aria-labelledby="categories-heading">
                            <ul class="space-y-3 text-sm text-gray-700">
                                <li class="flex items-center">
                                    <input type="radio" id="all-transmission" name="transmission" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" checked>
                                    <label for="all-transmission" class="ml-2 cursor-pointer">Semua</label>
                                </li>
                                <li class="flex items-center">
                                    <input type="radio" id="manual" name="transmission" value="manual" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="manual" class="ml-2 cursor-pointer">Manual</label>
                                </li>
                                <li class="flex items-center">
                                    <input type="radio" id="matic" name="transmission" value="matic" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="matic" class="ml-2 cursor-pointer">Matic</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Kapasitas --}}
                    <div id="accordion-price" data-accordion="collapse">
                        <h2 id="price-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left text-gray-900 !bg-transparent !text-gray-900 hover:text-blue-600 focus:outline-none focus:ring-0 transition-colors duration-200"
                                data-accordion-target="#price-body"
                                aria-expanded="false"
                                aria-controls="price-body">
                                Kapasitas
                                <svg class="w-3 h-3 shrink-0 transition-transform duration-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="price-body" class="hidden pt-2" aria-labelledby="price-heading">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-700">Minimal: <span id="capacity-value" class="text-blue-600 font-bold">2</span> orang</span>
                                </div>
                                <input id="capacity-range" type="range" min="2" max="8" value="2" step="2"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                                <div class="flex justify-between text-xs text-gray-500 px-0.5">
                                    <span>2</span>
                                    <span>4</span>
                                    <span>6</span>
                                    <span>8</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Reset Filter Button --}}
                    <button id="reset-filter" class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                        Reset Filter
                    </button>

                </div>
            </aside>

            <main class="lg:col-span-9">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-sm text-gray-600">
                        Menampilkan <span id="result-count" class="font-semibold">0</span> mobil
                    </p>
                    <button id="dropdownSortButton" data-dropdown-toggle="dropdownSort" class="text-gray-500 hover:bg-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m-4 4l4 4"></path></svg>
                        Sort
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <div id="dropdownSort" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownSortButton">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 sort-option" data-sort="newest">Newest</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 sort-option" data-sort="price-asc">Increasing price</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 sort-option" data-sort="price-desc">Decreasing price</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Container untuk mobil --}}
                <div id="car-list-container" class="grid grid-cols-1 gap-6">

                    @foreach ($allJenis as $jenis)
                        <div class="car-item bg-white rounded-lg shadow-md border border-gray-100 p-6 flex items-start space-x-6 relative min-h-72"
                            data-merek="{{ strtolower($jenis->merek) }}"
                            data-transmisi="{{ strtolower($jenis->transmisi) }}"
                            data-kapasitas="{{ $jenis->kapasitas }}"
                            data-harga="{{ $jenis->harga_rental_per_hari }}">

                            {{-- Gambar Mobil --}}
                            <div class="flex-shrink-0 w-72 min-h-48">
                                <div class="absolute top-2 right-2">
                                    @if ($jenis->stok_tersedia <= 3 && $jenis->stok_tersedia > 0)
                                        <span class="text-white text-xs px-2 py-1 rounded" style="background-color: rgb(234 179 8 / var(--tw-bg-opacity, 1))">{{ $jenis->stok_tersedia }} Unit</span>
                                    @elseif ($jenis->stok_tersedia > 3)
                                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">{{ $jenis->stok_tersedia }} Unit</span>
                                    @else <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">{{ $jenis->stok_tersedia }} Unit</span>
                                    @endif

                                </div>
                                <img src="{{ asset('storage/jenis_mobil/' . $jenis->foto_mobil) }}" alt="Foto {{ $jenis->merek }}" class="w-full h-full object-cover rounded-lg">

                                {{-- <button class="w-full px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-150 font-semibold text-sm mt-9">
                                    See Details
                                </button> --}}
                            </div>

                            {{-- Kolom Kiri: Detail Mobil --}}
                            <div class="flex-grow">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $jenis->merek }} (<span class="text-yellow-800">{{ $jenis->tahun }}</span>)</h3>
                                    @if ($jenis->stok_tersedia > 0)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">Available</span>
                                    @else <span class="bg-red-500 text-red-300 text-xs font-medium px-3 py-1 rounded-full">Unavailable</span>
                                    @endif

                                </div>
                                <p class="text-gray-500 text-sm mb-4">{{ ucfirst($jenis->transmisi) }}</p>

                                {{-- Warna --}}
                                <div class="flex items-center gap-2 mb-4">
                                    <span class="text-sm text-gray-600 font-medium">Warna:</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($jenis->warna as $warna)
                                            <span class="inline-flex items-center p-2 rounded-full text-xs font-medium bg-gray-100 text-gray-700 border border-gray-300">
                                                {{-- <span class="w-2.5 h-2.5 rounded-full mr-1.5"></span> --}}
                                                {{ $warna }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Fitur-fitur --}}
                                <div class="flex items-center space-x-6 text-gray-700 text-sm mb-4">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                                        <span>{{ $jenis->kapasitas }} Orang</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                                        <span>-</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 4.293a1 1 0 00-1.414 0L10 6.38v.83l-1-1a1 1 0 10-1.414 1.414l.83.83h-.83l-1.5-1.5a1 1 0 00-1.414 1.414L7.636 10l-1.707 1.707a1 1 0 001.414 1.414L9 11.414v-.83l1 1a1 1 0 001.414-1.414l-.83-.83h.83l1.5 1.5a1 1 0 001.414-1.414L12.364 10l1.707-1.707a1 1 0 000-1.414zM10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
                                        <span>AC</span>
                                    </div>
                                </div>

                                {{-- Poin-poin spesifik --}}
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center space-x-2 text-gray-700 text-sm">
                                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <span>Fuel Tank Full</span>
                                    </div>
                                    <div class="flex items-center space-x-2 text-gray-700 text-sm">
                                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <span>Unlimited Mileage</span>
                                    </div>
                                    {{-- <div class="flex items-center space-x-2 text-gray-700 text-sm">
                                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <span>{{ implode(', ', $jenis->warna) }}</span>
                                    </div> --}}
                                </div>
                            </div>

                            {{-- Kolom Kanan: Harga dan Tombol --}}
                            <div class="flex flex-col items-end justify-between flex-shrink-0">
                                <div class="text-right mb-6 mt-24">
                                    <span class="text-xl font-bold text-gray-900 mt-1 hargaPerHari">{{ $jenis->harga_rental_per_hari }}</span>
                                </div>
                                {{-- <div class="text-center mb-3">
                                    <p class="text-xs text-gray-600">
                                        Stok: <span class="font-semibold text-green-600">5 unit</span>
                                    </p>
                                </div> --}}
                                <div class="flex flex-col space-y-2 w-full">
                                    <a href="{{ route('pemesanan.checkout', $jenis->id_jenis_mobil) }}" class="px-6 py-3 transition duration-150 rounded-lg font-semibold text-sm text-center
                                        @if ($jenis->stok_tersedia > 0) bg-green-500 text-white hover:bg-green-600
                                        @else bg-gray-500 text-white hover:text-gray-500 cursor-not-allowed pointer-events-none
                                        @endif
                                        ">
                                        @if ($jenis->stok_tersedia > 0) Sewa Sekarang @else Stok Habis @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- No Results Message --}}
                <div id="no-results" class="hidden text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada mobil ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter pencarian Anda.</p>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Fungsi Format Rupiah
        const formatRupiah = (angka) => {
            const formattedNumber = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(Number(angka));
            return `Rp. ${formattedNumber},00 / hari`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // 1. Format Rupiah
            const hargaElements = document.querySelectorAll('.hargaPerHari');
            hargaElements.forEach(span => {
                const rawValue = span.textContent.trim();
                span.textContent = formatRupiah(rawValue);
            });

            // 2. Filter Variables
            let searchQuery = '';
            let selectedTransmission = '';
            let minCapacity = 2;

            const carItems = document.querySelectorAll('.car-item');
            const noResults = document.getElementById('no-results');
            const resultCount = document.getElementById('result-count');
            const carContainer = document.getElementById('car-list-container');

            // 3. Filter Function
            function filterCars() {
                let visibleCount = 0;

                carItems.forEach(item => {
                    const merek = item.dataset.merek;
                    const transmisi = item.dataset.transmisi;
                    const kapasitas = parseInt(item.dataset.kapasitas);

                    // Check all conditions
                    const matchSearch = merek.includes(searchQuery.toLowerCase());
                    const matchTransmission = !selectedTransmission || transmisi === selectedTransmission;
                    const matchCapacity = kapasitas >= minCapacity;

                    if (matchSearch && matchTransmission && matchCapacity) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                // Update result count
                resultCount.textContent = visibleCount;

                // Show/hide no results message
                if (visibleCount === 0) {
                    noResults.classList.remove('hidden');
                    carContainer.classList.add('hidden');
                } else {
                    noResults.classList.add('hidden');
                    carContainer.classList.remove('hidden');
                }
            }

            // 4. Search Input Event
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('input', function(e) {
                searchQuery = e.target.value;
                filterCars();
            });

            // 5. Transmission Radio Event
            const transmissionRadios = document.querySelectorAll('input[name="transmission"]');
            transmissionRadios.forEach(radio => {
                radio.addEventListener('change', function(e) {
                    selectedTransmission = e.target.value;
                    filterCars();
                });
            });

            // 6. Capacity Range Event
            const capacityRange = document.getElementById('capacity-range');
            const capacityValue = document.getElementById('capacity-value');

            capacityRange.addEventListener('input', function(e) {
                minCapacity = parseInt(e.target.value);
                capacityValue.textContent = minCapacity;
                filterCars();
            });

            // 7. Reset Filter Button
            const resetButton = document.getElementById('reset-filter');
            resetButton.addEventListener('click', function() {
                // Reset all filters
                searchInput.value = '';
                searchQuery = '';

                document.getElementById('all-transmission').checked = true;
                selectedTransmission = '';

                capacityRange.value = 2;
                minCapacity = 2;
                capacityValue.textContent = 2;

                filterCars();
            });

            // 8. Sorting Function
            const sortOptions = document.querySelectorAll('.sort-option');
            sortOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sortType = this.dataset.sort;
                    sortCars(sortType);
                });
            });

            function sortCars(sortType) {
                const itemsArray = Array.from(carItems);

                itemsArray.sort((a, b) => {
                    const priceA = parseInt(a.dataset.harga);
                    const priceB = parseInt(b.dataset.harga);

                    switch(sortType) {
                        case 'price-asc':
                            return priceA - priceB;
                        case 'price-desc':
                            return priceB - priceA;
                        default:
                            return 0;
                    }
                });

                // Re-append sorted items
                itemsArray.forEach(item => {
                    carContainer.appendChild(item);
                });
            }

            // 9. Initial count
            filterCars();

            // 10. Accordion icon rotation
            document.querySelectorAll('[data-accordion-target]').forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('svg');
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    if (isExpanded) {
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });
        });
    </script>

    <style>
        /* Custom styling untuk range slider */
        #capacity-range::-webkit-slider-thumb {
            width: 16px;
            height: 16px;
            background: #3b82f6;
            cursor: pointer;
            border-radius: 50%;
        }

        #capacity-range::-moz-range-thumb {
            width: 16px;
            height: 16px;
            background: #3b82f6;
            cursor: pointer;
            border-radius: 50%;
        }

        /* Smooth transition untuk item visibility */
        .car-item {
            transition: opacity 0.3s ease-in-out;
        }

        .car-item.hidden {
            display: none;
        }
    </style>
</x-user-page-template>
