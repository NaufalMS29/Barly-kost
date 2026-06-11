<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cari penghuni yang sedang login dan belum bayar
        $penghuni = Penghuni::where('user_id', Auth::id())
                           ->with(['kamar', 'tagihans' => function($query) {
                               $query->where('status', 'Belum Lunas')->latest();
                           }])
                           ->first();

        if (!$penghuni) {
            return redirect()->route('dashboard')->with('error', 'Data penghuni tidak ditemukan.');
        }

        $tagihan = $penghuni->tagihans->first();

        if (!$tagihan) {
            return redirect()->route('dashboard')->with('error', 'Tidak ada tagihan yang perlu dibayar.');
        }

        return view('pembayaran.create', compact('penghuni', 'tagihan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'metode_pembayaran' => 'required|string|max:255',
            'tanggal_pembayaran' => 'nullable|date',
            'catatan' => 'nullable|string|max:500',
        ]);

        $tagihan = Tagihan::findOrFail($request->tagihan_id);

        // Pastikan tagihan milik user yang sedang login
        if ($tagihan->penghuni->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        // Pastikan tagihan belum lunas
        if ($tagihan->status === 'Lunas') {
            return redirect()->route('dashboard')->with('error', 'Tagihan ini sudah lunas.');
        }

        // Handle Midtrans payment
        if ($request->metode_pembayaran === 'Midtrans') {
            // Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Parameter Transaksi
            $orderId = 'PAY-' . time() . '-' . $tagihan->id . '-' . rand(1000, 9999);
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $tagihan->jumlah_tagihan,
                ],
                'customer_details' => [
                    'first_name' => $tagihan->penghuni->nama_penghuni,
                    'phone' => $tagihan->penghuni->no_telepon,
                ],
                'item_details' => [[
                    'id' => $tagihan->id,
                    'price' => (int) $tagihan->jumlah_tagihan,
                    'quantity' => 1,
                    'name' => 'Pembayaran Tagihan - ' . $tagihan->penghuni->kamar->nama_kamar,
                ]],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Update tagihan dengan snap token dan order_id baru
            $tagihan->update([
                'snap_token' => $snapToken,
                'midtrans_order_id' => $orderId
            ]);

            return back()->with('snapToken', $snapToken);
        }

        // Handle manual payments
        DB::transaction(function () use ($request, $tagihan) {
            // Buat pembayaran
            Pembayaran::create([
                'tagihan_id' => $tagihan->id,
                'jumlah_pembayaran' => $tagihan->jumlah_tagihan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_pembayaran' => $request->tanggal_pembayaran,
            ]);

            // Update status tagihan menjadi Lunas
            $tagihan->update([
                'status' => 'Lunas',
                'tanggal_lunas' => $request->tanggal_pembayaran,
            ]);
        });

        return redirect()->route('dashboard')->with('success', 'Pembayaran berhasil! Selamat bergabung sebagai penghuni.');
    }

    public function pay($tagihanId)
    {
        $tagihan = Tagihan::with(['penghuni.kamar'])->findOrFail($tagihanId);

        // Pastikan tagihan milik user yang sedang login
        if ($tagihan->penghuni->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        // Pastikan tagihan belum lunas
        if ($tagihan->status === 'Lunas') {
            return redirect()->route('dashboard')->with('error', 'Tagihan ini sudah lunas.');
        }

        $penghuni = $tagihan->penghuni;

        // Redirect ke halaman pembayaran Midtrans
        return view('pembayaran.create', compact('penghuni', 'tagihan'));
    }

    /**
     * Handle Midtrans payment notification
     */
    public function notification(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        // Cari tagihan berdasarkan order_id
        $tagihan = Tagihan::where('midtrans_order_id', $order_id)->first();

        if (!$tagihan) {
            return response()->json(['status' => 'error', 'message' => 'Order ID not found'], 404);
        }

        DB::transaction(function () use ($tagihan, $transaction, $type, $order_id, $fraud) {
            if ($transaction == 'capture') {
                // For credit card, check if fraud is challenged or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // Set payment status to pending
                        $tagihan->update(['status' => 'Pending']);
                    } else {
                        // Payment success
                        $this->updatePaymentSuccess($tagihan, $type);
                    }
                }
            } elseif ($transaction == 'settlement') {
                // Payment success
                $this->updatePaymentSuccess($tagihan, $type);
            } elseif ($transaction == 'pending') {
                // Payment pending
                $tagihan->update(['status' => 'Pending']);
            } elseif ($transaction == 'deny') {
                // Payment denied
                $tagihan->update(['status' => 'Gagal']);
            } elseif ($transaction == 'expire') {
                // Payment expired
                $tagihan->update(['status' => 'Expired']);
            } elseif ($transaction == 'cancel') {
                // Payment canceled
                $tagihan->update(['status' => 'Dibatalkan']);
            }
        });

        return response()->json(['status' => 'success']);
    }

    private function updatePaymentSuccess($tagihan, $paymentType)
    {
        // Update tagihan status
        $tagihan->update([
            'status' => 'Lunas',
            'tanggal_lunas' => now(),
        ]);

        // Create pembayaran record
        Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'jumlah_pembayaran' => $tagihan->jumlah_tagihan,
            'metode_pembayaran' => 'Midtrans (' . $paymentType . ')',
            'tanggal_pembayaran' => now(),
            'catatan' => 'Pembayaran via Midtrans',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
