<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kamar',
        'tipe',
        'foto_kamar',
        'lantai',
        'harga_bulanan',
        'listrik',
        'status',
    ];

    protected $casts = [
        'foto_kamar' => 'array',
    ];

    public function penghuni(){
        return $this->hasOne(Penghuni::class);
    }

    public function perbaikans(){
        return $this->hasMany(Perbaikan::class);
    }
}
