<?php

namespace App\Filament\Pages;

use App\Filament\Resources\CouponResource\Widgets\CouponLog;
use App\Filament\Resources\CouponResource\Widgets\CouponOverview;
use App\Filament\Resources\CouponResource\Widgets\CouponProgress;
use App\Filament\Resources\CouponResource\Widgets\CouponQrCode;
use App\Filament\Resources\CouponResource\Widgets\ScanQRCodeWidget;
use App\Models\Coupon;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class Dashboard extends Page  implements HasForms
{
  use InteractsWithForms;
  protected static ?string $navigationIcon = 'heroicon-o-home';
  protected static ?string $navigationLabel = 'Dashboard';
  protected static string $view = 'filament.pages.dashboard';
  protected int | string | array $columnSpan = 'full';


  protected function getHeaderWidgets(): array
  {
    return [
      CouponOverview::class,
      CouponProgress::class,
      CouponLog::class,
      CouponQrCode::class,
    ];
  }
}
