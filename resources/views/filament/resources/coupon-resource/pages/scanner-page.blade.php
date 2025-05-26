<x-filament-panels::page>
    <x-filament::section>
        <div class="space-y-4">
            <div id="reader" style="width: 100%;"></div>
            <div id="qr-reader-results" class="text-center text-gray-400"></div>
            <p class="text-center text-sm text-white">Arahkan kamera ke QR Code kupon.</p>
        </div>

        <script src="{{ asset('js/html5-qrcode-scanner.js') }}"></script>
        <script>
            let html5QRCodeScanner = new Html5QrcodeScanner(
                // target id dengan nama reader, lalu sertakan juga 
                // pengaturan untuk qrbox (tinggi, lebar, dll)
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 200,
                        height: 200,
                    },
                }
            );

            function onScanSuccess(decodedText, decodedResult) {
                // redirect ke link hasil scan
                window.location.href = decodedResult.decodedText;

                // membersihkan scan area ketika sudah menjalankan 
                // action diatas
                html5QRCodeScanner.clear();
            }

            // render qr code scannernya
            html5QRCodeScanner.render(onScanSuccess);
        </script>
    </x-filament::section>
</x-filament-panels::page>
