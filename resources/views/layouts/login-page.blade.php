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
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-outfit text-black antialiased">

        <a href="/" class="absolute top-4 right-4 text-gray-500 hover:text-blue-600 p-1 rounded-full transition duration-150" aria-label="Close">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </a>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F5F9FF] rel">


            <x-logo-and-title>sign in to your account</x-logo-and-title>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#F5F9FF] shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
                <div>
                    <div class="flex items-center my-6">
                        <hr class="flex-grow border-gray-700">
                        <span class="mx-3 text-sm text-gray-400">Or continue with</span>
                        <hr class="flex-grow border-gray-700">
                    </div>

                    <div class="flex gap-3">
                        <button class="flex items-center justify-center gap-2 bg-[#F5F9FF] hover:bg-[#ffd900] text-black shadow-md font-medium py-2 rounded-md w-1/2">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                            Google
                        </button>
                        <button class="flex items-center justify-center gap-2 bg-[#F5F9FF] hover:bg-[#ffd900] text-black shadow-md font-medium py-2 rounded-md w-1/2">
                            <img src="https://www.svgrepo.com/show/511330/apple-173.svg" class="w-5 h-5" alt="GitHub">
                            Apple
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
