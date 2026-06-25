<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewPembayaran extends ViewRecord
{
    protected static string $resource = PembayaranResource::class;

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
                Infolists\Components\Section::make('Informasi Pembayaran')
                    ->columns(2)
                    ->schema([
                        Infolists\Components\TextEntry::make('tagihan.penghuni.nama_penghuni')
                            ->label('Nama Penghuni'),
                        Infolists\Components\TextEntry::make('tagihan.jumlah_tagihan')
                            ->label('Total Tagihan')
                            ->money('idr'),
                        Infolists\Components\TextEntry::make('jumlah_pembayaran')
                            ->label('Jumlah Dibayar')
                            ->money('idr'),
                        Infolists\Components\TextEntry::make('tanggal_pembayaran')
                            ->label('Tanggal Pembayaran')
                            ->date('d M Y'),
                        Infolists\Components\TextEntry::make('metode_pembayaran')
                            ->label('Metode'),
                    ]),
            ]);
    }
}
