<x-page-style>
    @section('title', 'Carental | Rental Mobil Terbaik di Malang')

    <div class="relative w-full overflow-hidden">

        <div class="absolute inset-0 bg-cover bg-center">
            <img src="{{ asset("images/HEAD IMAGE 3.jpeg") }}" alt="">
            <div class="absolute inset-0 bg-black opacity-75"></div>
        </div>

        <div class="relative max-w-screen-xl mx-auto h-full flex flex-col justify-between p-8 sm:p-16 lg:p-24 text-white">

            <div class="flex justify-end w-full mb-8 space-x-4">
                @auth
                @if (Auth::user()->roles === 'admin')
                    <a
                        href="{{ url('/dashboard') }}"
                        class="px-4 py-2 text-sm font-medium text-white border border-white/50 rounded-lg hover:bg-blue-700
                        hover:text-gray-900 transition duration-150 ease-in-out">
                        Dashboard
                    </a>
                @endif

                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-white border border-white/50 rounded-lg hover:bg-blue-700
                         hover:text-gray-900 transition duration-150 ease-in-out">
                        Login
                    </a>
                    @endauth
                <a
                    href="{{ route('katalog') }}"
                    class="px-4 py-2 text-sm font-medium text-white border border-white/50 rounded-lg hover:bg-orange-500
                     hover:text-gray-900 transition duration-150 ease-in-out">
                    Katalog
                </a>
            </div>

            <div class="max-w-2xl mt-8 mb-8">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    CARENTAL
                </h1>
                <p class="text-xl opacity-90 mb-12 capitalize">
                    Booking sekarang, mobil siap jalan kapanpun! <br>
                    Telah dipercaya sejak 1945
                </p>
                <a href="{{ route('katalog') }}" class="inline-flex items-center justify-center px-6 py-3 text-base
                font-medium text-white bg-blue-700 rounded-lg
                 hover:bg-orange-500 focus:ring-4 focus:ring-orange-2   00 transition duration-150 ease-in-out">
                    Sewa Sekarang
                    <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293
                         3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4
                         .293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </div>

            {{-- Garis putih --}}
            <div class="h-px bg-white/50 w-full mt-8 mb-8"></div>

        </div>
    </div>

    {{-- PROMOTION 1 --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 mt-60">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="lg:pr-12">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight capitalize">
                    Fokus pada Kebebasan dan Petualangan
                </h1>

                <p class="text-lg text-gray-600 max-w-xl">
                    Jangan biarkan batasan transportasi menghalangi rencana Anda. Dengan armada mobil terbaru dan terawat kami,
                    Anda siap untuk petualangan spontan atau perjalanan bisnis penting.
                    Layanan 24/7 dan proses sewa cepat, karena waktu Anda terlalu berharga untuk dihabiskan menunggu.
                </p>

                </div>

            <div class="flex justify-center lg:justify-end">
                <div class="relative w-full max-w-lg lg:max-w-none rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{ asset("images/PROMOTION 1.jpg") }}" alt="">
                </div>
            </div>

        </div>
    </div>

    {{-- PROMOTION 2 --}}
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 mt-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="flex justify-center lg:justify-end">
                <div class="relative w-full max-w-lg lg:max-w-none rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{ asset("images/PROMOTION 2.jpg") }}" alt="">
                </div>
            </div>

            <div class="lg:pr-12">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight capitalize">
                    Fokus pada Proses Cepat dan Tanpa Ribet
                </h1>

                <p class="text-lg text-gray-600 max-w-xl">
                    Kami menghargai waktu Anda. Lupakan tumpukan formulir dan kejutan biaya tersembunyi.
                    Proses digital kami memastikan Anda mendapatkan kunci dengan cepat.
                    Harga yang tertera adalah harga yang Anda bayar. Itu janji kami.
                </p>

                </div>
        </div>
    </div>

    {{-- WHY CHOOSE US SECTION --}}
    <div class="mt-40 py-16">
        <div class="container mx-auto px-6 py-24 text-center">
            <h2 class="mt-2 text-4xl md:text-5xl font-extrabold text-gray-900">
                Mengapa harus memilih kami?
            </h2>
        </div>

        <div class="container mx-auto px-6 mt-16">
            <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 justify-center">

                {{-- 1. Kartu: Harga terjangkau --}}
                <x-why-must-choose-us-section
                    title="Harga terjangkau"
                    description="Segala alat gaming yang kami sewakan memiliki harga yang bersahabat untuk semua kalangan, sehingga Anda
                    dapat menikmati pengalaman bermain tanpa khawatir tentang biaya."
                    icon-path='<svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.345a4.76
                    4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866
                    -1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538
                    1.592m-3.879 12.171V21m0-18v2.2"/>
                    </svg>'
                />

                {{-- 2. Kartu: Kemudahan penyewaan --}}
                <x-why-must-choose-us-section
                    title="Kemudahan penyewaan"
                    description="Kamu tidak perlu repot-repot datang ke tempat kami. Cukup lakukan penyewaan secara online melalui
                    website kami dan alatnya akan diantar langsung ke lokasi kamu."
                    icon-path='<path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2
                    2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v
                    -6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>'
                />

                {{-- 3. Kartu: Kemudahan pembayaran --}}
                <x-why-must-choose-us-section
                    title="Kemudahan pembayaran"
                    description="Enggak punya cash? Tenang! Kami menerima berbagai metode pembayaran digital yang memudahkan kamu untuk
                    menyelesaikan transaksi tanpa ribet."
                    icon-path='<path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z"
                    clip-rule="evenodd"/><path fill-rule="evenodd" d="M2 11a2 2 0 0 1
                    2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" clip-rule="evenodd"/>
                    <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>'
                />

                {{-- 4. Kartu: Banyak pilihan alat gaming --}}
                <x-why-must-choose-us-section
                    title="Banyak pilihan alat gaming"
                    description="Kami menyediakan berbagai jenis alat gaming mulai dari konsol, aksesori, hingga game terbaru yang siap
                    untuk disewa sesuai dengan kebutuhan dan preferensi kamu."
                    icon-path='<path d="M20 7h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C10.4
                    2.842 8.949 2 7.5 2A3.5 3.5 0 0 0 4 5.5c.003.52.123 1.033.351 1.5H4a2
                    2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2Zm-9.942 0H7.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092
                    2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5
                    1.5 0 0 1 0 3h.003ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z"/>'
                />

            </div>
        </div>

    </div>

    <div class="flex justify-center mt-32">
        <a href="{{ route('katalog') }}" class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white
         bg-blue-700 rounded-lg hover:bg-orange-500 focus:ring-4 focus:ring-orange-200 transition duration-150 ease-in-out">
            Sewa Sekarang
            <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1
                1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </a>
    </div>

    {{-- FOOTER --}}

    <footer class="bg-[#e4e2e2] mt-72">
        <div class="border-t border-gray-300"></div>

        <div class="container mx-auto px-6 py-6 flex items-center justify-between">

            {{-- Copyright --}}
            <p class="text-gray-600 text-sm">
                © 2025 Console Hub Ofiicial Site.
            </p>
        </div>
    </footer>


</x-page-style>
