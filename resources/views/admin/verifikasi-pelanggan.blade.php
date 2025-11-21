{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <title>Verifikasi Pelanggan</title>
</head>
<body> --}}
<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">

            <div class="bg-gray-800 shadow-xl rounded-lg p-6 text-center">

                <h2 class="text-2xl font-bold text-white mb-4">
                    Verifikasi QR Code
                </h2>

                <div id="reader" class="w-full max-w-sm mx-auto"></div>

                <div id="result" class="mt-4 p-3 bg-indigo-600 text-white font-semibold rounded-md">
                    Menunggu Scan...
                </div>

            </div>

        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Hentikan scanner setelah sukses (opsional, tapi disarankan)
            html5QrcodeScanner.clear();

            // Perbarui tampilan hasil
            document.getElementById('result').innerHTML = `TOKEN DITEMUKAN: ${decodedText}`;
            document.getElementById('result').classList.add('bg-green-100', 'text-green-800');

            console.log(`Scan result: ${decodedText}`, decodedResult);

            // Di sini Anda akan mengirim token ke Laravel melalui AJAX/form
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            {
                fps: 10,
                qrbox: { width: 250, height: 250 } // Gunakan objek untuk qrbox
            }
        );
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</x-app-layout>
{{-- </body>
</html> --}}
