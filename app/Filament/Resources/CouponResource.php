<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Endroid\QrCode\Builder\Builder;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CouponResource extends Resource
{

    protected static ?string $model = Coupon::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel  = 'Kupon';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('receiver_id')
                    ->relationship('receiver', 'name')
                    ->searchable()
                    ->reactive()
                    ->preload()
                    ->required()
                    ->afterStateUpdated(function (callable $set, $state) {
                        $receiver = \App\Models\Receiver::find($state);

                        if ($receiver) {
                            $code =  Str::upper(Str::uuid());
                            $set('code', $code);
                        }
                    }),
                Forms\Components\TextInput::make('code')
                    ->unique(ignoreRecord: true)
                    ->readonly()
                    ->reactive()
                    ->required(),
                Forms\Components\Toggle::make('is_taken')
                    ->label('Sudah Diambil?')
                    ->visible(fn(string $context) => $context === 'edit'),
                Forms\Components\DatePicker::make('taken_at')
                    ->label('Waktu pengambilan')
                    ->visible(fn(string $context) => $context === 'edit')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('receiver.name')
                    ->label('Penerima')
                    ->copyable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_taken')
                    ->label('Pengambilan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('taken_at')
                    ->label('Waktu Pengambilan')
                    ->dateTimeTooltip()
                    ->copyable()
                    ->since()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTimeTooltip()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTimeTooltip()
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('qr_code_preview')
                    ->label('QR Code')
                    ->getStateUsing(function ($record) {
                        // generate QR code base64 dari code kupon
                        $result = Builder::create()
                            ->data($record->code)
                            ->size(100)
                            ->margin(0)
                            ->build();

                        // buat data URI base64 image png
                        $base64 = 'data:' . $result->getMimeType() . ';base64,' . base64_encode($result->getString());
                        return $base64;
                    })
                    ->square() // supaya gambarnya kotak
                    ->sortable(false)
                    ->searchable(false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->color('warning'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
            'scan' => Pages\ScannerPage::route('/scan'),
        ];
    }
}
