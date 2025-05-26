<?php

namespace App\Filament\Resources\CouponResource\Widgets;

use App\Models\Coupon;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class CouponLog extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort  = 3;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->heading('Catatan Pengambilan')
            ->query(
                Coupon::where('is_taken', true)->latest()->limit(10),
            )
            ->columns([
                TextColumn::make('receiver.name')->label('Nama')->searchable(),
                TextColumn::make('code')->label('Kode Kupon'),
                TextColumn::make('taken_at')
                    ->label('Waktu Diambil')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable(),
            ]);
    }
}
