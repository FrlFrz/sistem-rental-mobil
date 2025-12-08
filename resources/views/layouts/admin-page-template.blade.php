<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="{{ asset("images/LOGO.png") }}">
        <title>@yield('title', config('app.name'))</title>

        <!-- Fonts -->
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        {{-- Styles / Scripts --}}
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

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
    <body class="font-outfit antialiased">

            {{-- Backdrop Manual Sidebar --}}
            <div id="backdrop-overlay"
                class="overflow-y-auto overflow-x-hidden hidden fixed top-0 right-0 left-0 justify-center z-40 items-center bg-gray-700 opacity-5 w-full inset-0" style="opacity: 0.8;">
            </div>

            <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.admin-navigation')

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
                {{ $slot }}
            </main>
        </div>


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
        </script>
    </body>
</html>
