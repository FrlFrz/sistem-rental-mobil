<x-layout=admin-page-template>
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

                    <div class="bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between">
                            <div>
                            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $sumTotals }}</h5>
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Jumlah Peminjaman Selesai (6 Bulan Terakhir)</p>
                            </div>
                        </div>
                    <div id="area-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // 1. Ambil Data dari PHP
        const chartCategories = @json($months);
        const chartData = @json($totals);

        // 2. Definisikan Options Anda...
        const options = {
            chart: {
                height: "100%",
                maxWidth: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                enabled: false,
                },
                toolbar: {
                show: false,
                },
            },
            tooltip: {
                enabled: true,
                x: {
                show: false,
                },
            },
            fill: {
                type: "gradient",
                gradient: {
                opacityFrom: 0.55,
                opacityTo: 0,
                shade: "#1C64F2",
                gradientToColors: ["#1C64F2"],
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                width: 6,
            },
            grid: {
                show: false,
                strokeDashArray: 4,
                padding: {
                left: 2,
                right: 2,
                top: 0
                },
            },
            series: [
                {
                    name: "Jumlah Pemesanan Selesai",
                    data: chartData,
                    color: "#1A56DB",
                },
            ],
            xaxis: {
                categories: chartCategories,
                labels: {
                    show: true,
                    style: {
                        colors: '#A0AEC0', // Contoh: Gray-400 (Cocok untuk Dark Mode)
                        fontSize: '12px', // Opsional: Atur ukuran font jika diperlukan
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
            },
            yaxis: {
                 show: true,
                 labels: {
                    formatter: function (value) {
                        return value.toFixed(0);
                    },
                    show: true,
                    style: {
                        colors: '#22C55E', // Contoh: Gray-400 (Cocok untuk Dark Mode)
                        fontSize: '12px', // Opsional: Atur ukuran font jika diperlukan
                        cssClass: 'apexcharts-yaxis-label',
                    },
                 }
            }
        };

        // 6. Inisialisasi Chart
        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("area-chart"), options);
            chart.render();
        }
    </script>
</x-layout=admin-page-template>
