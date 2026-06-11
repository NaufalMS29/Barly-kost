<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
    ];

    public function tagihan(){
        return $this->belongsTo(Tagihan::class);
    }

    protected static function booted()
    {
        static::created(function ($pembayaran) {
            if ($pembayaran->tagihan && $pembayaran->tagihan->status !== 'Lunas') {
                $pembayaran->tagihan->update(['status' => 'Lunas']);
            }
        });
    }
}