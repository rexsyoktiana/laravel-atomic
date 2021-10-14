<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiStatus extends Model
{
    use HasFactory;
    protected $table = 'transaksi_status';
    protected $fillable = [
        'nama'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id', 'status_id');
    }
}
