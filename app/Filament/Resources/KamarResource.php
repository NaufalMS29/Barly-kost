<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kamar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KamarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KamarResource\RelationManagers;

class KamarResource extends Resource
{
    protected static ?string $model = Kamar::class;
    
    protected static ?string $navigationGroup = 'Manajemen Penyewaan';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('nama_kamar')
                ->label('Nama Kamar')
                ->required(),

            Forms\Components\Select::make('tipe')
                ->label('Tipe')
                ->options([
                    'AC' => 'AC',
                    'Non-AC' => 'Non-AC',
                ])
                ->required(),

            Forms\Components\FileUpload::make('foto_kamar')
                ->label('Foto Kamar')
                ->multiple()
                ->image()
                ->directory('foto-kamar')
                ->maxFiles(5)
                ->reorderable()
                ->disk('public')
                ->imageEditor()
                ->nullable(),

            Forms\Components\TextInput::make('lantai')
                ->numeric()
                ->label('Lantai')
                ->required(),

            Forms\Components\TextInput::make('harga_bulanan')
                ->numeric()
                ->required()
                ->prefix('Rp ')
                ->label('Harga Bulanan'),

            Forms\Components\Select::make('listrik')
                ->label('Listrik')
                ->options([
                    'Token' => 'Token',
                    'Include' => 'Include',
                ])
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'Kosong' => 'Kosong',
                    'Terisi' => 'Terisi',
                    'Perbaikan' => 'Perbaikan',
                ])
                ->placeholder('Pilih Status Kamar')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('nama_kamar')
                ->label('Nama Kamar')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('tipe')
                ->label('Tipe')
                ->sortable(),

            Tables\Columns\ImageColumn::make('foto_kamar')
                ->label('Foto')
                ->disk('public')
                ->limit(1),

            Tables\Columns\TextColumn::make('lantai')
                ->label('Lantai')
                ->sortable(),

            Tables\Columns\TextColumn::make('harga_bulanan')
                ->money('IDR')
                ->label('Harga Bulanan')
                ->sortable(),

            Tables\Columns\TextColumn::make('listrik')
                ->label('Listrik'),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'Kosong',
                    'danger' => 'Terisi',
                    'warning' => 'Perbaikan',
                ])
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'Kosong' => 'Kosong',
                        'Terisi' => 'Terisi',
                        'Perbaikan' => 'Perbaikan',
                    ])
                    ->placeholder('Semua Status'),
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
            'index' => Pages\ListKamars::route('/'),
            'create' => Pages\CreateKamar::route('/create'),
            'view' => Pages\ViewKamar::route('/{record}'),
            'edit' => Pages\EditKamar::route('/{record}/edit'),
        ];
    }
}
