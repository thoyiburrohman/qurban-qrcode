<?php

namespace App\Filament\Resources\CouponResource\Widgets;

use App\Models\Coupon;
use App\Models\Receiver;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Builder\Builder;

class CouponQrCode extends Widget
{
    use HasWidgetShield;
    protected static string $view = 'filament.resources.coupon-resource.widgets.coupon-qr-code';
    protected static ?int $sort  = 4;
    protected int | string | array $columnSpan = 2;

    public ?string $qr = null;
    public ?string $name = null;
    public ?string $code = null;
    public ?string $coupon = null;

    public function mount(): void
    {
        $user = Auth::user();
        $user->id;

        // Misalnya user punya relasi ke penerima
        $receiver = Receiver::where('user_id', $user->id)->first();
        if (!$receiver || !$receiver->coupon) {
            return;
        }

        $this->name = $receiver->name;
        $this->code = $receiver->coupon->code;
        $this->coupon = $receiver->coupon->is_taken;
        $result = Builder::create()
            ->data(route('coupons.validate', $receiver->coupon->code))
            ->size(350)
            ->margin(0)
            ->build();
        $this->qr = 'data:' . $result->getMimeType() . ';base64,' . base64_encode(
            $result->getString()
        );
    }
}
