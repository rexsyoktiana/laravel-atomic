<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dompet extends Model
{
    use HasFactory;
    protected $table = 'dompet';
    protected $fillable = [
        'nama',
        'referensi',
        'deskripsi',
        'status_id'
    ];

    public function dompetStatus()
    {
        return $this->hasOne(DompetStatus::class, 'id', 'status_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'dompet_id', 'id');
    }
}
