<?php

namespace App\Filament\Resources\CouponResource\Pages;

use App\Filament\Resources\CouponResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoupons extends ListRecords
{
    protected static string $resource = CouponResource::class;
    protected static ?string $title = 'Kupon';
    protected  ?string $subheading = 'Data Kupon Daging';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-c-plus')
                ->label('Tambah')
                ->extraAttributes([
                    'class' => 'rounded-xl',
                ]),
            Actions\CreateAction::make('scan')
                ->label('Scan Kupon')
                ->icon('heroicon-o-qr-code')
                ->color('gray')
                ->url(fn(): string => url('coupons/scan'))
        ];
    }
}
