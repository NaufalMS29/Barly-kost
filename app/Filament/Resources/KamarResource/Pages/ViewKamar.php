<?php

namespace App\Filament\Resources\KamarResource\Pages;

use App\Filament\Resources\KamarResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewKamar extends ViewRecord
{
    protected static string $resource = KamarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Detail Kamar')
                    ->schema([

                        Infolists\Components\ImageEntry::make('foto_kamar')
                            ->label('Foto Kamar')
                            ->height(200)
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('nama_kamar')
                            ->label('Nama Kamar')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                            ->weight('bold'),

                        Infolists\Components\TextEntry::make('tipe')
                            ->label('Tipe')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'AC' => 'success',
                                'Non-AC' => 'gray',
                            }),

                        Infolists\Components\TextEntry::make('lantai')
                            ->label('Lantai'),

                        Infolists\Components\TextEntry::make('harga_bulanan')
                            ->label('Harga Bulanan')
                            ->money('IDR'),

                        Infolists\Components\TextEntry::make('listrik')
                            ->label('Listrik')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Token' => 'warning',
                                'Include' => 'success',
                            }),

                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Kosong' => 'success',
                                'Terisi' => 'danger',
                                'Perbaikan' => 'warning',
                            }),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime(),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Terakhir Diupdate')
                            ->dateTime(),

                    ])
                    ->columns(2),
            ]);
    }
}
