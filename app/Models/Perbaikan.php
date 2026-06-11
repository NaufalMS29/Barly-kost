<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perbaikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id',
        'judul',
        'deskripsi',
        'status',
    ];

    public function kamar(){
        return $this->belongsTo(Kamar::class);
    }
}
