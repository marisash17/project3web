<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'layanan_id',
        'teknisi_id',
        'tanggal_pemesanan',
        'jadwal_service',
        'total_harga',
        'metode_pembayaran',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

public function layanan()
{
    return $this->belongsTo(Layanan::class, 'layanan_id');
}

public function teknisi()
{
    return $this->belongsTo(Teknisi::class, 'teknisi_id');
}

}
