<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'kode',
        'deskripsi',
        'tanggal',
        'nilai',
        'dompet_id',
        'kategori_id',
        'status_id'
    ];

    public function transaksiStatus()
    {
        return $this->hasOne(TransaksiStatus::class, 'id', 'status_id');
    }

    public function dompet()
    {
        return $this->belongsTo(Dompet::class, 'dompet_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
