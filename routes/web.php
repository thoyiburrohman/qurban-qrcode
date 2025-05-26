<?php

use App\Models\Coupon;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route;

route::get('/validasi/{code}', function ($code) {
    $coupon = Coupon::where('code', $code)->first();

    if (!$coupon) {
        Notification::make()
            ->title('Kupon Tidak Ditemukan')
            ->body('QR Code tidak valid atau kupon tidak ada.')
            ->danger()
            ->send();
        return  redirect()->back();
        // return view('filament.pages.validasi', [
        //     'status' => 'invalid',
        //     'message' => '❌ Kupon tidak ditemukan.',
        // ]);
    }

    if ($coupon->is_taken) {
        Notification::make()
            ->title('Kupon Sudah Diambil')
            ->body("Kupon atas nama: {$coupon->receiver->name} dengan kode: $code sudah diambil sebelumnya.")
            ->warning()
            ->send();
        return  redirect()->back();
    }

    $coupon->update(['is_taken' => true, 'taken_at' => Carbon::now()]);

    Notification::make()
        ->title('Kupon Berhasil Diambil!')
        ->body("Kupon atas nama: {$coupon->receiver->name} dengan kode: $code berhasil diupdate.")
        ->success()
        ->send();
    return  redirect()->back();
})->name('coupons.validate');
