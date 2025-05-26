<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Resources\ReceiverResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReceiver extends EditRecord
{
    protected static string $resource = ReceiverResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Penerima berhasil diperbarui';
    }
}
