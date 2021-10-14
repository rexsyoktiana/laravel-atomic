<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable = [
        'nama',
        'deskripsi',
        'status_id'
    ];

    public function kategoriStatus()
    {
        return $this->hasOne(KategoriStatus::class, 'id', 'status_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'kategori_id', 'id');
    }
}
