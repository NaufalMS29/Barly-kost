<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penghuni_id',
        'jumlah_tagihan',
        'status',
        'tanggal_lunas',
        'midtrans_order_id',
        'snap_token',
    ];

    public function penghuni(){
        return $this->belongsTo(Penghuni::class);
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class);
    }
}
