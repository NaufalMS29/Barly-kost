<?php

namespace App\Filament\Resources\PenghuniResource\Pages;

use App\Filament\Resources\PenghuniResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreatePenghuni extends CreateRecord
{
    protected static string $resource = PenghuniResource::class;

    protected function afterCreate(): void
    {
        // Update kamar status to Terisi
        $this->record->kamar->update(['status' => 'Terisi']);

        // Create first tagihan
        $this->record->tagihans()->create([
            'jumlah_tagihan' => $this->record->kamar->harga_bulanan,
            'status' => 'Belum Lunas',
        ]);
        // Redirect back to list
        $this->redirect(static::$resource::getUrl('index'));
    }

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }
}
