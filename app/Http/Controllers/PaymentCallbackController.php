<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Log the incoming request
        Log::info('Midtrans Callback Received', [
            'request_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        Log::info('Midtrans Notification Data', [
            'transaction' => $transaction,
            'type' => $type,
            'order_id' => $order_id,
            'fraud' => $fraud
        ]);

        // Cari tagihan berdasarkan order_id
        $tagihan = Tagihan::where('midtrans_order_id', $order_id)->first();

        if (!$tagihan) {
            Log::error('Tagihan not found for order_id', ['order_id' => $order_id]);
            return response()->json(['message' => 'Tagihan not found'], 404);
        }

        if ($transaction == 'capture' || $transaction == 'settlement') {
            if ($type == 'credit_card' && $fraud == 'challenge') {
                // Do nothing or set to pending
                Log::info('Payment challenge for credit card', ['order_id' => $order_id]);
            } else {
                // Pembayaran Berhasil
                if ($tagihan->status !== 'Lunas') {
                    $tagihan->update([
                        'status' => 'Lunas',
                        'tanggal_lunas' => now(),
                    ]);

                    // Buat record Pembayaran otomatis
                    Pembayaran::create([
                        'tagihan_id' => $tagihan->id,
                        'jumlah_pembayaran' => $tagihan->jumlah_tagihan,
                        'tanggal_pembayaran' => now(),
                        'metode_pembayaran' => 'Transfer', // Default untuk Midtrans
                        'bukti_pembayaran' => 'Midtrans Order ID: ' . $order_id,
                    ]);

                    Log::info('Payment successful and recorded', ['tagihan_id' => $tagihan->id, 'order_id' => $order_id]);
                }
            }
        } elseif ($transaction == 'pending') {
            // Menunggu pembayaran
            Log::info('Payment pending', ['order_id' => $order_id]);
        } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
            // Pembayaran gagal
            Log::info('Payment failed', ['order_id' => $order_id, 'status' => $transaction]);
        }

        return response()->json(['message' => 'Payment status updated']);
    }

    public function handleSuccess($orderId)
    {
        // Cari tagihan berdasarkan order_id
        $tagihan = Tagihan::where('midtrans_order_id', $orderId)->first();

        if (!$tagihan) {
            return redirect()->route('dashboard')->with('error', 'Tagihan tidak ditemukan.');
        }

        // Cek jika sudah lunas
        if ($tagihan->status === 'Lunas') {
            return redirect()->route('dashboard')->with('success', 'Pembayaran sudah berhasil diproses.');
        }

        // Update status tagihan
        $tagihan->update([
            'status' => 'Lunas',
            'tanggal_lunas' => now(),
        ]);

        // Buat record Pembayaran
        Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'jumlah_pembayaran' => $tagihan->jumlah_tagihan,
            'tanggal_pembayaran' => now(),
            'metode_pembayaran' => 'Midtrans',
            'bukti_pembayaran' => 'Midtrans Order ID: ' . $orderId,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pembayaran berhasil! Terima kasih.');
    }
}