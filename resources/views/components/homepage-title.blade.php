<div class="relative w-full">
    <img src="{{ asset('images/MAIN PICTURE.jpg')}}" alt="" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-[#357DFF]/60"></div>

    <!-- Object di atas gambar -->
    <div class="absolute inset-0 flex flex-col items-center  text-center text-white">
        <p class="text-5xl tracking-wider text-[#ffe645] font-bold mt-6">RENTAL MOBIL TERBAIK DI MALANG</p>
        <p class="text-3xl mt-9 font-bold mb-1">Booking Sekarang, Mobil Siap Jalan Kapan Pun!</p>
        <p class="text-lg">Telah Dipercaya Sejak 1945</p>

        <div class="relative h-[200px] w-[800px]">

            <!-- Konten di atas gambar -->
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-6">

                <!-- Wrapper utama -->
                <div class="relative w-full flex justify-center">

                    <!-- Card berwarna -->
                    <form action="{{ route('katalog.index') }}" method="GET" class="relative w-full flex justify-center"    >
                    <div class="bg-[#ffee00] rounded-xl shadow-lg px-6 py-4 w-full max-w-5xl flex items-center justify-between">

                        <div class="flex flex-wrap items-center gap-4">
                            <!-- Pick-up date -->
                            <div class="flex flex-col">
                                <label class="text-black text-sm font-semibold">Pick-up date</label>
                                <input type="date"
                                       name="pickup_date"
                                       class="text-black border rounded-md px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>


                            <!-- Drop-off date -->
                            <div class="flex flex-col">
                                <label class="text-black text-sm font-semibold">Drop-off date</label>
                                <input type="date"
                                       name="dropoff_date"
                                       class="text-black border rounded-md px-4 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Kanan: tombol search -->
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md">
                            Search
                        </button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
