<x-page-style>
    @section('title', 'Carental | Katalog')
        {{-- NAVBAR --}}
    <nav class="w-full py-4 bg-[rgb(245,249,253)] border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-6 flex justify-between items-center max-w-7xl">
            <div href="/" class="text-gray-900 font-extrabold tracking-widest">
                <x-application-logo class="w-9 h-10"/>
            </div>

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
                                        <a href="{{ url('/dashboard') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Dashboard Admin
                                        </a>
                                        <a href="{{ url('/profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                            <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            Profil Saya
                                        </a>
                                    @endif

                                    @if (Auth::user()->roles === 'user')
                                    {{-- Opsi Umum (Profil Saya) --}}
                                    <a href="{{ url('/user-profile') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
                                        <svg class="w-5 h-5 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Profil Saya
                                    </a>
                                    @endif


                                    {{-- Opsi Umum (Histori Pemesanan) --}}
                                    <a href="{{ url('/histori-rental') }}" class="text-gray-700 flex items-center px-4 py-2 text-sm hover:bg-gray-100 hover:text-black transition duration-150">
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
                <li aria-current="page"><span class="mx-2">/</span><span class="text-gray-900">Electronics</span></li>
            </ol>
        </nav>

        <h1 class="text-2xl font-bold text-gray-900 mb-6">
            Electronics
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <aside class="lg:col-span-3">
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-100">

                    {{-- Kategori (Categories) --}}
                    <div id="accordion-categories" data-accordion="collapse">
                        <h2 id="categories-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold
                            text-left text-gray-900" data-accordion-target="#categories-body"
                                aria-expanded="false"
                                aria-controls="categories-body">
                                Categories
                                <svg class="w-3 h-3 shrink-0"aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="categories-body" class="hidden pt-2"ria-labelledby="categories-heading">
                            {{-- Isi Konten Kategori --}}
                            <ul class="space-y-3 text-sm text-gray-700">
                                {{-- Checkbox items --}}
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> TV, Audio-Video</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Desktop PC</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Gaming</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Monitors</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Laptops</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Console</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Tablets</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Foto</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Fashion</li>
                                <li><input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2"> Books</li>
                            </ul>
                            <a href="#" class="text-sm text-blue-600 mt-2 inline-block hover:underline">See more &rarr;</a>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Rating --}}
                    <div id="accordion-rating" data-accordion="collapse">
                        <h2 id="rating-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left
                             text-gray-900" data-accordion-target="#rating-body"
                                aria-expanded="false"
                                aria-controls="rating-body">
                                Rating
                                <svg class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="rating-body" class="hidden pt-2" aria-labelledby="rating-heading">
                            <p class="text-sm text-gray-500">Rating filter content here...</p>
                        </div>
                    </div>

                    <hr class="my-4 border-gray-200">

                    {{-- Price --}}
                    <div id="accordion-price" data-accordion="collapse">
                        <h2 id="price-heading">
                            <button type="button" class="flex items-center justify-between w-full py-3 font-semibold text-left text-gray-900" data-accordion-target="#price-body"
                                aria-expanded="false"
                                aria-controls="price-body">
                                Price
                                <svg class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="price-body" class="hidden pt-2" aria-labelledby="price-heading">
                            <p class="text-sm text-gray-500">Price range slider/inputs...</p>
                        </div>
                    </div>

                </div>
            </aside>

            <main class="lg:col-span-9">
                <div class="flex justify-end mb-6">
                    <button id="dropdownSortButton" data-dropdown-toggle="dropdownSort" class="text-gray-500 hover:bg-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m-4 4l4 4"></path></svg>
                        Sort
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <div id="dropdownSort" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownSortButton">
                            <li class="px-4 py-2 font-bold text-blue-600">The most popular</li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Newest</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Increasing price</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Decreasing price</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">No. reviews</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Discount %</a></li>
                        </ul>
                    </div>
                </div>

                {{-- BARIS INI YANG DIPERBAIKI --}}
                <div class="grid grid-cols-1 gap-6">

                    <x-car-list-in-catalog></x-car-list-in-catalog>
                    <x-car-list-in-catalog></x-car-list-in-catalog>
                    <x-car-list-in-catalog></x-car-list-in-catalog>
                    <x-car-list-in-catalog></x-car-list-in-catalog>

                </div>
            </main>
        </div>
    </div>

</x-page-style>
