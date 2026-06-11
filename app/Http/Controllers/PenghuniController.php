<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Kamar;
use App\Models\Tagihan;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penghunis = Penghuni::where('user_id', Auth::id())->with('kamar')->get();
        return view('penghuni.index', compact('penghunis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Ambil kamar yang masih kosong
        $kamars = Kamar::where('status', 'Kosong')->get();

        // Jika ada parameter kamar_id dari URL, ambil kamar tersebut
        $selectedKamar = null;
        if ($request->has('kamar') && $request->kamar) {
            $selectedKamar = Kamar::where('id', $request->kamar)->where('status', 'Kosong')->first();
        }

        return view('penghuni.create', compact('kamars', 'selectedKamar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'nama_penghuni' => 'required|string|max:255',
            'no_ktp' => 'required|string|unique:penghunis,no_ktp',
            'no_telepon' => 'required|string|max:20',
            'tanggal_masuk' => 'required|date|after_or_equal:today',
        ]);

        // Check if room is still available
        $kamar = Kamar::findOrFail($request->kamar_id);
        if ($kamar->status !== 'Kosong') {
            return redirect()->back()->with('error', 'Kamar ini sudah tidak tersedia.')->withInput();
        }

        // Check if user already has an active room
        $existingPenghuni = Penghuni::where('user_id', Auth::id())
            ->whereNull('tanggal_keluar')
            ->first();
        if ($existingPenghuni) {
            return redirect()->back()->with('error', 'Anda sudah memiliki kamar aktif.')->withInput();
        }

        // Create the penghuni record
        $penghuni = Penghuni::create([
            'user_id' => Auth::id(),
            'kamar_id' => $request->kamar_id,
            'nama_penghuni' => $request->nama_penghuni,
            'no_ktp' => $request->no_ktp,
            'no_telepon' => $request->no_telepon,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        // Update kamar status to Terisi
        $kamar->update(['status' => 'Terisi']);

        // Create first tagihan
        $penghuni->tagihans()->create([
            'jumlah_tagihan' => $kamar->harga_bulanan,
            'status' => 'Belum Lunas',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran tagihan pertama.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penghuni $penghuni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penghuni $penghuni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penghuni $penghuni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penghuni $penghuni)
    {
        //
    }
}
