<?php

namespace App\Filament\Resources\CouponResource\Pages;

use App\Filament\Resources\CouponResource;
use App\Models\Coupon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;

class ScannerPage extends Page
{
    protected static string $resource = CouponResource::class;
    protected int | string | array $columnSpan = 'full';
    protected static string $view = 'filament.resources.coupon-resource.pages.scanner-page';

    public function processScannedCode(string $qrCodeContent): void
    {

        try {
            $coupon = Coupon::where('code', $qrCodeContent)->first();

            if (!$coupon) {
                Notification::make()
                    ->title('Kupon Tidak Ditemukan')
                    ->body('QR Code tidak valid atau kupon tidak ada.')
                    ->danger()
                    ->send();
                // Opsional: Tetap biarkan scanner aktif untuk scan berikutnya
                // $this->dispatch('reset-scanner'); // Kirim event ke JS untuk reset scanner
                return;
            }

            if ($coupon->is_taken) {
                Notification::make()
                    ->title('Kupon Sudah Diambil')
                    ->body("Kupon dengan kode: {$qrCodeContent} sudah diambil sebelumnya.")
                    ->warning()
                    ->send();
                // $this->dispatch('reset-scanner');
                return;
            }

            // Update status kupon menjadi sudah diambil
            $coupon->update(['is_taken' => true, 'taken_at' => now()]);

            Notification::make()
                ->title('Kupon Berhasil Diambil!')
                ->body("Kupon {$qrCodeContent} berhasil diupdate.")
                ->success()
                ->send();

            // Refresh halaman atau widget lain jika perlu (misalnya widget dashboard yang menampilkan statistik)
            // $this->dispatch('refreshDashboard'); // Jika ada widget dashboard yang perlu diperbarui
            $this->dispatch('reset-scanner'); // Reset scanner untuk scan berikutnya

        } catch (\Exception $e) {
            Notification::make()
                ->title('Terjadi Kesalahan')
                ->body('Tidak dapat memproses scan. Silakan coba lagi.')
                ->danger()
                ->send();
            $this->dispatch('reset-scanner');
        }
    }
}
