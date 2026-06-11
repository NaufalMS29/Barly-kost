<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagihanResource\Pages;
use App\Filament\Resources\TagihanResource\RelationManagers;
use App\Models\Tagihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TagihanResource extends Resource
{
    protected static ?string $model = Tagihan::class;

    protected static ?string $navigationGroup = 'Manajemen Keuangan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('penghuni_id')
                ->label('Penghuni')
                ->relationship('penghuni', 'nama')
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('jumlah_tagihan')
                ->label('Jumlah Tagihan')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'Belum Lunas' => 'Belum Lunas',
                    'Lunas' => 'Lunas',
                ])
                ->default('Belum Lunas')
                ->required(),

            Forms\Components\DatePicker::make('tanggal_lunas')
                ->label('Tanggal Lunas')
                ->visible(function ($get) {
                    return $get('status') === 'Lunas';
                }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penghuni.nama_penghuni')
                ->label('Penghuni')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('jumlah_tagihan')
                ->label('Jumlah')
                ->money('idr')
                ->sortable(),

            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'danger' => 'Belum Lunas',
                    'success' => 'Lunas',
                ]),

            Tables\Columns\TextColumn::make('tanggal_lunas')
                ->label('Tanggal Lunas')
                ->date()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y')
                ->toggleable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'Belum Lunas' => 'Belum Lunas',
                    'Lunas' => 'Lunas',
                ])
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTagihans::route('/'),
            'create' => Pages\CreateTagihan::route('/create'),
            'edit' => Pages\EditTagihan::route('/{record}/edit'),
        ];
    }
}
