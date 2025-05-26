<?php

namespace App\Filament\Resources\CouponResource\Widgets;

use App\Models\Coupon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class CouponOverview extends BaseWidget
{
    use HasWidgetShield;
    protected static ?int $sort  = 1;
    // protected int | string | array $columnSpan = [
    //     'md' => 1,
    //     'xl' => 1,
    // ];

    protected function getStats(): array
    {
        $total = Coupon::count();
        $taken = Coupon::where('is_taken', true)->count();
        $remaining = $total - $taken;

        return [
            Stat::make('Total Kupon', number_format($total))
                ->description('Jumlah semua kupon')
                ->color('info'),

            Stat::make('Sudah Diambil', number_format($taken))
                ->description('Kupon yang telah diambil')
                ->color('success'),

            Stat::make('Belum Diambil', number_format($remaining))
                ->description('Kupon belum diambil')
                ->color('danger'),
        ];
    }
}
