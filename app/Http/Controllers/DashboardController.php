<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Perbaikan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $penghuni = $user->penghuni;

        $kamarNama = $penghuni?->kamar?->nama_kamar;

        $tagihans = $penghuni ? Tagihan::where('penghuni_id', $penghuni->id)->latest()->get() : collect();

        $tagihanBulanIni = $penghuni ? Tagihan::where('penghuni_id', $penghuni->id)
            ->whereMonth('created_at', now()->month)
            ->sum('jumlah_tagihan') : 0;

        $perbaikanCount = $penghuni ? Perbaikan::where('kamar_id', $penghuni->kamar_id)->count() : 0;

        return view('dashboard', compact('kamarNama', 'tagihans', 'tagihanBulanIni', 'perbaikanCount'));
    }
}
