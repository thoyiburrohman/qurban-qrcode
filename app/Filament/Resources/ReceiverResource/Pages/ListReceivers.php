<?php

namespace App\Filament\Resources\ReceiverResource\Pages;

use App\Filament\Imports\ReceiverImporter;
use App\Filament\Imports\UserImporter;
use App\Filament\Resources\ReceiverResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ImportAction;

class ListReceivers extends ListRecords
{
    protected static string $resource = ReceiverResource::class;
    protected static ?string $title = 'Penerima';
    protected  ?string $subheading = 'Data Penerima Daging';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-c-plus')
                ->label('Tambah')
                ->extraAttributes([
                    'class' => 'rounded-xl',
                ]),
            ImportAction::make()
                ->icon('heroicon-s-cloud-arrow-up')
                ->label('Import')
                ->importer(UserImporter::class),
        ];
    }
}
