<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Flowbite CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* 1. Memastikan Konten Scanner Terpusat */
        #reader div {
            /* Mengatasi masalah perataan di dalam wadah scanner */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Vertikal tengah */
            align-items: center;    /* Horizontal tengah */
            text-align: center;
            }

        /* 2. Mengganti Warna Font (Contoh: Putih) */
        #reader span,
        #reader a,
        #reader label,
        #reader select {
            /* Mengganti warna teks, penting untuk dark mode */
            color: white !important; /* Gunakan !important jika tertimpa Tailwind/Flowbite */
            text-decoration: none !important;
        }

        /* 3. Menyesuaikan Padding (Opsional) */
        #reader {
            /* Memastikan elemen div eksternal memiliki ruang yang cukup */
            padding: 20px;
        }
        .btn-crud {
            background-color: #059669;
        }
        .btn-crud::hover {
            background-color: #047857;
        }
        </style>
    </head>
    <body class="font-sans antialiased">

            {{-- Backdrop Manual Sidebar --}}
            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @include('layouts.sidebar')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{-- @yield('content') --}}
            </main>
        </div>
        {{-- CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        {{-- Script Sidebar Responsive --}}
        <script>
            const toggleEl = document.getElementById('hamburger-logo');

            toggleEl.addEventListener('click', () => {
                console.log('tes');
            const sidebar = document.getElementById('logo-sidebar');
            const backdrop = document.getElementById('backdrop-overlay');
            const isHidden = sidebar.classList.contains('hidden');

            if (isHidden) {
                sidebar.classList.remove('hidden');
                backdrop.classList.remove('hidden');

            } else {
                sidebar.classList.add('hidden');
                backdrop.classList.add('hidden');
            }
        });

        // Chart Settings
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
            name: "New users",
            data: [6500, 6418, 6456, 6526, 6356, 6456],
            color: "#1A56DB",
            },
        ],
        xaxis: {
            categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
            labels: {
            show: false,
            },
            axisBorder: {
            show: false,
            },
            axisTicks: {
            show: false,
            },
        },
        yaxis: {
            show: false,
        },
        }

        if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("area-chart"), options);
        chart.render();
        }

        </script>
    </body>
</html>
