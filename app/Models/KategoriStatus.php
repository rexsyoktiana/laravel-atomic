<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriStatus extends Model
{
    use HasFactory;
    protected $table = 'kategori_status';
    protected $fillable = [
        'nama',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id', 'status_id');
    }
}
