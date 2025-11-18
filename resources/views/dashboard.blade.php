<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

                    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 mb-6">

                        <div class="bg-gray-800 dark:bg-[#1f2937] shadow-xl rounded-lg overflow-hidden p-4 border border-gray-700 hover:shadow-2xl transition duration-200 h-36 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">TOTAL KENDARAAN</p>
                                    <p class="text-3xl font-extrabold text-white">{{ $stats['totalUnitMobil'] ?? 'N/A' }}</p>
                                </div>
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17a1 1 0 011-1h16a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1zm4-1h10M3 11l6-4m5 4l6-4m-12 8h12M4 7h16a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1V8a1 1 0 011-1z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Seluruh aset yang terdaftar.</p>
                        </div>

                        <div class="bg-gray-800 dark:bg-[#1f2937] shadow-xl rounded-lg overflow-hidden p-4 border border-gray-700 hover:shadow-2xl transition duration-200 h-36 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">MOBIL TERSEDIA</p>
                                    <p class="text-3xl font-extrabold text-white">{{ $stats['totalMobilTersedia'] ?? 'N/A' }}</p>
                                </div>
                                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Siap disewa hari ini.</p>
                        </div>

                        <div class="bg-gray-800 dark:bg-[#1f2937] shadow-xl rounded-lg overflow-hidden p-4 border border-gray-700 hover:shadow-2xl transition duration-200 h-36 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-2">MOBIL DALAM RENTAL</p>
                                    <div class="text-3xl font-extrabold text-white mb-2">{{ $stats['totalMobilDirental'] ?? 'N/A' }}</div>

                                    <div class="w-full bg-gray-700 rounded-full h-2">
                                        <div class="bg-blue-400 h-2 rounded-full" style="width: {{ ($pemesananDirental ?? 0) / ($totalMobil ?? 1) * 100 }}%"></div>
                                    </div>
                                </div>
                                <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Unit yang sedang beroperasi.</p>
                        </div>

                        <div class="bg-gray-800 dark:bg-[#1f2937] shadow-xl rounded-lg overflow-hidden p-4 border border-gray-700 hover:shadow-2xl transition duration-200 h-36 flex flex-col justify-between">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-1">MENUNGGU PENGAMBILAN</p>
                                    <p class="text-3xl font-extrabold text-white">{{ $stats['totalMobilDipesan'] ?? 'N/A' }}</p>
                                </div>
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Perlu verifikasi QR Code segera.</p>
                        </div>

                    </div>

                    {{-- Chart --}}

                    <div class="bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                        <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">N/A</h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Peminjaman Minggu Ini</p>
                        </div>
                        <div
                        class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
                        12%
                        <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                        </svg>
                        </div>
                    </div>
                    <div id="area-chart"></div>
                    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                        <div class="flex justify-between items-center pt-5">
                        <!-- Button -->
                        <button
                            id="dropdownDefaultButton"
                            data-dropdown-toggle="lastDaysdropdown"
                            data-dropdown-placement="bottom"
                            class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                            type="button">
                            Last 7 days
                            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                </li>
                                <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                </li>
                                <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                                </li>
                                <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                                </li>
                                <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                                </li>
                            </ul>
                        </div>
                        <a
                            href="#"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Users Report
                            <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
