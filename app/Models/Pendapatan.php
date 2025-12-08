<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    protected $fillable = [
        'teknisi_id',
        'customer_id',
        'pemesanan_id',
        'layanan_id',
        'jumlah',
        'tanggal',
        'keterangan'
    ];

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, 'teknisi_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
