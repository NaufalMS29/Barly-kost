<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghuni extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'nama_penghuni',
        'no_ktp',
        'no_telepon',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    protected $casts = [
    'tanggal_masuk' => 'date',
    'tanggal_keluar' => 'date',
];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class);
    }

    public function tagihans(){
        return $this->hasMany(Tagihan::class);
    }
}
