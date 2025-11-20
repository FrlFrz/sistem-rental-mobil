<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Booking Confirmation' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        {{-- Container Utama --}}
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">

            {{-- Header Konfirmasi Booking --}}
            <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-100">
                <h1 class="text-xl font-semibold text-gray-800">Confirm your booking</h1>
                <p class="text-xl font-bold text-gray-800">Total: Rp 100.000.00</p>
            </div>

            {{-- Konten Utama --}}
            <form action="{{ route('process.booking') }}" method="POST">
                @csrf
                <div class="lg:grid lg:grid-cols-3">

                    {{-- Kolom Kiri: Driver & Payment Details (Menggunakan 2 kolom grid) --}}
                    <div class="lg:col-span-2 p-8">

                        {{-- Bagian 1: DRIVER DETAILS --}}
                        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">DRIVER DETAILS</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Input Fields: First Name, Last Name, Date of Birth, Email --}}
                            {{-- (Kode input di sini sama seperti sebelumnya) --}}

                            {{-- First Name --}}
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First name*</label>
                                <input type="text" name="first_name" id="first_name" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>

                            {{-- Last Name --}}
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name*</label>
                                <input type="text" name="last_name" id="last_name" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mt-6">
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of birth*</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>

                        {{-- Email --}}
                        <div class="mt-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email*</label>
                            <input type="email" name="email" id="email" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>

                        {{-- Checkbox Persetujuan --}}
                        <div class="space-y-4 mt-8">
                            <div>
                                <label class="flex items-start">
                                    <input type="checkbox" name="agree_payment" required
                                        class="h-4 w-4 text-green-600 border-gray-300 rounded mt-1">
                                    <span class="ml-3 text-sm text-gray-600">I understand that once payment is completed, the transaction cannot be refunded and I accept the <a href="#" class="text-blue-600 hover:text-blue-800 underline">Cancellation Policy</a>.</span>
                                </label>
                            </div>
                            <div>
                                <label class="flex items-start">
                                    <input type="checkbox" name="agree_terms" required
                                        class="h-4 w-4 text-green-600 border-gray-300 rounded mt-1">
                                    <span class="ml-3 text-sm text-gray-600">I agree that the rental provider reserves the right to refuse or cancel the transaction if they detect fraudulent indications...</span>
                                </label>
                            </div>
                            <div>
                                <label class="flex items-start">
                                    <input type="checkbox" name="verify_details" required
                                        class="h-4 w-4 text-green-600 border-gray-300 rounded mt-1">
                                    <span class="ml-3 text-sm text-gray-600">I verify that the booking and payment details I have provided are accurate and can be fully accounted for.</span>
                                </label>
                            </div>
                        </div>

                        {{-- Bagian 2: Choose your payment --}}
                        <div class="mt-10 p-6 bg-gray-50 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Choose your payment!</h3>

                            {{-- Menggunakan Komponen Payment Logos --}}
                            <x-payment-logos />

                            {{-- Form VISA Card --}}
                            <div class="space-y-4">
                                <h4 class="text-md font-semibold text-gray-700">VISA</h4>

                                {{-- Card Number --}}
                                <div>
                                    <label for="card_number" class="block text-sm font-medium text-gray-700">Card number</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="XXXX XXXX XXXX XXXX" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                </div>

                                {{-- Expiration Date & CVV (Grid) --}}
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="col-span-2">
                                        <label for="expiry_date" class="block text-sm font-medium text-gray-700">Registration date</label>
                                        <div class="flex space-x-2 mt-1">
                                            <input type="text" name="expiry_month" id="expiry_month" placeholder="MM/YY" required
                                                class="block w-1/2 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm text-center">
                                            <input type="text" name="expiry_year" id="expiry_year" placeholder="XXXX" required
                                                class="block w-1/2 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm text-center">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                        <input type="text" name="cvv" id="cvv" placeholder="XXX" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm text-center">
                                    </div>
                                </div>
                            </div>

                            {{-- Checkbox Kebijakan Privasi --}}
                            <div class="space-y-3 mt-6">
                                <div>
                                    <label class="flex items-start">
                                        <input type="checkbox" name="agree_privacy" required
                                            class="h-4 w-4 text-green-600 border-gray-300 rounded mt-1">
                                        <span class="ml-3 text-sm text-gray-600">I have read, understood and accept the <a href="#" class="text-blue-600 hover:text-blue-800 underline">Privacy Policy</a>.</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="flex items-start">
                                        <input type="checkbox" name="agree_parental" required
                                            class="h-4 w-4 text-green-600 border-gray-300 rounded mt-1">
                                        <span class="ml-3 text-sm text-gray-600">I acknowledge that I have read, understood and agree to the <a href="#" class="text-blue-600 hover:text-blue-800 underline">Parental Terms and Conditions</a>.</span>
                                    </label>
                                </div>
                            </div>

                            {{-- Tombol Process --}}
                            <div class="flex justify-end pt-6">
                                <button type="submit"
                                    class="w-full md:w-auto inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                                    PROCESS
                                </button>
                            </div>
                        </div>
                    </div> {{-- End Kolom Kiri --}}

                    {{-- Kolom Kanan: Booking Summary --}}
                    <div class="lg:col-span-1 bg-gray-100 p-8 border-l border-gray-200">
                        <div class="sticky top-8">

                            {{-- Detail Mobil --}}
                            <h3 class="text-xl font-semibold mb-4 text-gray-800">McLaren P1</h3>

                            <div class="flex items-center justify-between mt-4 text-sm text-gray-600">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 002 2h4a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V10a2 2 0 012-2h4a2 2 0 002-2z"></path></svg>
                                    <span>Automatic</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    <span>AC</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-300 my-6"></div>

                            {{-- Detail Tanggal --}}
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Thursday, 6 November 2025</p>
                                    <p class="text-xs text-gray-500">Pick up date</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Sunday, 9 November 2025</p>
                                    <p class="text-xs text-gray-500">Return date</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-300 my-6"></div>

                            {{-- Total Pembayaran --}}
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-medium text-gray-700">Total:</p>
                                <p class="text-xl font-bold text-red-600">Rp 80.000.000,00</p>
                            </div>
                            <p class="text-xs text-right text-gray-500 mt-1">Include Tax Fee</p>
                        </div>
                    </div> {{-- End Kolom Kanan --}}

                </div>
            </form>
        </div>
    </div>

</body>
</html>
