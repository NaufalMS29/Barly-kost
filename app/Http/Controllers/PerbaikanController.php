<?php

namespace App\Http\Controllers;

use App\Models\Perbaikan;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $penghuni = Penghuni::where('user_id', $user->id)->first();

        if (!$penghuni) {
            return redirect()->route('dashboard')->with('error', 'Data penghuni tidak ditemukan.');
        }

        $perbaikans = Perbaikan::where('kamar_id', $penghuni->kamar_id)->orderBy('created_at', 'desc')->get();

        return view('perbaikan.index', compact('perbaikans', 'penghuni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $penghuni = Penghuni::where('user_id', $user->id)->first();

        if (!$penghuni) {
            return redirect()->route('dashboard')->with('error', 'Anda belum terdaftar sebagai penghuni.');
        }

        return view('perbaikan.create', ['penghuni' => $penghuni]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $data['status'] = 'pending';

        Perbaikan::create($data);

        return redirect()->route('perbaikan.index')->with('success', 'Permintaan perbaikan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Perbaikan $perbaikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perbaikan $perbaikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perbaikan $perbaikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perbaikan $perbaikan)
    {
        //
    }
}
