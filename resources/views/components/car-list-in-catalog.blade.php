<div class="bg-white rounded-lg shadow-md border border-gray-100 p-6 flex items-start space-x-6 relative min-h-72">
    {{-- Gambar Mobil --}}
    <div class="flex-shrink-0 w-72 h-auto"> {{-- Menggunakan ukuran yang lebih proporsional --}}
        <img src="{{ asset('images/PROMOTION 1.jpg') }}" alt="McLaren P1" class="w-full h-full object-cover rounded-lg">

        <button class="w-full px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-150 font-semibold text-sm mt-9">
                See Details
        </button>
    </div>

    {{-- Kolom Kiri: Detail Mobil (Nama, Transmisi, Fitur) --}}
    <div class="flex-grow">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-xl font-bold text-gray-900">McLaren P1</h3>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">Available</span>
        </div>
        <p class="text-gray-500 text-sm mb-4">Automatic</p>

        {{-- Fitur-fitur --}}
        <div class="flex items-center space-x-6 text-gray-700 text-sm mb-4">
            <div class="flex items-center space-x-1">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                <span>2</span>
            </div>
            <div class="flex items-center space-x-1">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                <span>-</span> {{-- Asumsi ini untuk jumlah bagasi atau sejenisnya --}}
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
        </div>
    </div>

    {{-- Kolom Kanan: Harga dan Tombol --}}
    <div class="flex flex-col items-end justify-between flex-shrink-0">
        <div class="text-right mb-6 mt-24">
            <span class="bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">SAVE 20%</span>
            <p class="text-gray-500 line-through text-sm mt-1">Rp 25.000.000,00/day</p>
            <p class="text-xl font-bold text-gray-900 mt-1">Rp 20.000.000,00/day</p>
        </div>

        <div class="flex flex-col space-y-2 w-full"> {{-- Tombol dibuat stack vertikal --}}

            <button class="w-full px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-150 font-semibold text-sm">
                Rent Now
            </button>
        </div>
    </div>
</div>
