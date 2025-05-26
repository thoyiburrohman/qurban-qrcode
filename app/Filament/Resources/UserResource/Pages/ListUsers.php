<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected  ?string $subheading = 'Data User';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-c-plus')
                ->label('Tambah')
                ->extraAttributes([
                    'class' => 'rounded-xl',
                ]),
        ];
    }
}
