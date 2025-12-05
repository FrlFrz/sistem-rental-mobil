{{-- resources/views/verifikasi/qr_konversi_page.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Converter</title>
    <style>body { visibility: hidden; }</style>
</head>
<body>

    <canvas id="qr-canvas"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = '{{ $token }}';
            const canvasElement = document.getElementById('qr-canvas');

            // 3. Generate QR Code ke Canvas
            new QRious({
                element: canvasElement,
                value: token,
                size: 300,
                padding: 20, // Quiet Zone diukur dalam piksel (px)
                level: 'H' // Tingkat koreksi error tinggi
            });

            const returnUrl = '{{ $returnTo }}';

            // 4. Konversi Canvas ke Data URL PNG dan Download
            // (Perlu sedikit penundaan untuk memastikan rendering selesai)
            setTimeout(() => {
                const dataUrl = canvasElement.toDataURL("image/png");

                // Pemicu Download
                const a = document.createElement('a');
                a.href = dataUrl;
                a.download = `qr-${token}.png`;

                document.body.appendChild(a);
                a.click();

                // Bersihkan elemen
                document.body.removeChild(a);
                document.body.removeChild(canvasElement);

                // 1. Tentukan URL Tujuan
                let redirectPath;

                // Cek apakah URL sebelumnya mengandung '/histori-rental'
                if (returnUrl.includes('/histori-pemesanan')) {
                    // Redirect ke Histori Rental, mempertahankan query parameter (misalnya ?open_modal=123)
                    redirectPath = returnUrl;
                }
                // Cek apakah URL sebelumnya mengandung '/pemesanan'
                else if (returnUrl.includes('/pemesanan')) {
                    // Redirect ke Index Pemesanan
                    redirectPath = '{{ route('pemesanan.index') }}';
                }
                // Jika tidak ada yang cocok, fallback ke Dashboard atau Index utama
                else {
                    redirectPath = '/dashboard';
                }

                // 2. Redirect
                window.location.href = redirectPath;
            }, 100);
        });
    </script>
</body>
</html>
