<?php

namespace App\Filament\Resources\CouponResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\Coupon;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class CouponProgress extends Widget
{
    use HasWidgetShield;
    protected static string $view = 'filament.resources.coupon-resource.widgets.coupon-progress';
    protected static ?int $sort  = 2;
    protected  int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $total = Coupon::count();
        $taken = Coupon::where('is_taken', true)->count();
        $percentage = $total > 0 ? round(($taken / $total) * 100, 1) : 0;
        $progressColor = match (true) {
            $percentage >= 75 => 'green',
            $percentage >= 50 => 'yellow',
            default => 'red',
        };
        $coupon = Coupon::all();
        return compact('total', 'taken', 'percentage', 'progressColor', 'coupon');
    }
}
