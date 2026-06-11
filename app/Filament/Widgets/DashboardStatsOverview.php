<?php

namespace App\Filament\Widgets;

use App\Models\Kamar;
use App\Models\Tagihan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class DashboardStatsOverview extends BaseWidget
{
    // Opsional: Mengatur seberapa cepat data diperbarui (polling)
    protected static ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count(); 

        $persentaseOkupansi = $totalKamar > 0 
            ? round(($kamarTerisi / $totalKamar) * 100) 
            : 0;

        $colorOkupansi = $persentaseOkupansi > 80 ? 'success' : ($persentaseOkupansi > 50 ? 'warning' : 'danger');

         $totalTunggakan = Tagihan::where('status', 'belum_bayar')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah_tagihan');

        return [
            // Widget 1: Okupansi
            Stat::make('Okupansi Kos', $persentaseOkupansi . '%')
                ->description($kamarTerisi . ' dari ' . $totalKamar . ' kamar terisi')
                ->descriptionIcon('heroicon-m-home-modern')
                ->chart([70, 80, 85, $persentaseOkupansi]) 
                ->color($colorOkupansi),

            // Widget 2: Tunggakan
            Stat::make('Total Tunggakan (Bulan Ini)', 'Rp ' . number_format($totalTunggakan, 0, ',', '.'))
                ->description('Tagihan belum dibayar')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('danger'), 
        ];
    }
}