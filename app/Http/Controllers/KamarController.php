<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kamar::query();

        // Filter berdasarkan tipe
        if ($request->filled('tipe') && $request->tipe !== 'Semua Tipe') {
            $query->where('tipe', $request->tipe);
        }

        // Filter berdasarkan status
        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian nama kamar
        if ($request->filled('search')) {
            $query->where('nama_kamar', 'like', '%' . $request->search . '%');
        }

        $kamars = $query->orderBy('lantai', 'asc')->paginate(9)->withQueryString();
        return view('welcome', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamar $kamar)
    {
        // Ensure kamar exists
        if (!$kamar) {
            return redirect()->route('landing')->with('error', 'Kamar tidak ditemukan');
        }

        return view('kamar.detail', compact('kamar'));
    }

    /**
     * Show the booking form for the specified room.
     */
    public function pesan(Kamar $kamar)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ensure kamar exists
        if (!$kamar) {
            return redirect()->route('landing')->with('error', 'Kamar tidak ditemukan');
        }

        if ($kamar->status !== 'Kosong') {
            return redirect()->route('kamar.detail', $kamar)
                ->with('error', 'Kamar ini sudah tidak tersedia.');
        }

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        $existingPenghuni = Penghuni::where('user_id', $userId)
            ->whereNull('tanggal_keluar')
            ->first();
        if ($existingPenghuni) {
            return redirect()->route('kamar.detail', $kamar)
                ->with('error', 'Anda sudah memiliki kamar aktif. Silakan hubungi admin untuk perubahan.');
        }

        return view('kamar.pesan', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        //
    }
}
