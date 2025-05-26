<?php

namespace App\Filament\Imports;

use App\Models\User;
use App\Models\Receiver;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class DataImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Nama')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('email')
                ->requiredMapping()
                ->rules(['required', 'email']),
            ImportColumn::make('password')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?User
    {
        // return User::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new User();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your user import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
    protected function afterCreate(): void
    {
        $this->record->assignRole('penerima');
        $receiver = Receiver::create([
            'user_id' => $this->record->id,
            'name' => $this->record->name,
            'nik' => $this->record->nik,
        ]);
        Coupon::create([
            'receiver_id' => $receiver->id,
            'code' => Str::upper(Str::uuid()),
        ]);
    }
}
