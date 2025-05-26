<x-filament::widget>
    @if ($qr)
        @if ($coupon != 0)
            <div class="flex  items-center justify-center h-full text-center mt-96">
                <div>
                    <p class="text-lg text-white-700 mb-2">Maaf, kupon Anda sudah di gunakan.</p>
                </div>
            </div>
        @else
            <div class="text-center">
                <img src="{{ $qr }}" alt="QR Code" class="mx-auto w-90 h-90 mb-4">
                <div class="text-white-700 capitalize">
                    <strong>{{ $name }}</strong><br>
                    Kode: <code>{{ $code }}</code>
                </div>
            </div>
        @endif
    @else
        <div class="flex  items-center justify-center h-full text-center mt-96">
            <div>
                <p class="text-lg text-white-700 mb-2">Maaf, kupon belum tersedia untuk akun Anda.</p>
                <p class="text-md text-white-500">Silakan hubungi panitia untuk informasi lebih lanjut.</p>
            </div>
        </div>
    @endif

</x-filament::widget>
