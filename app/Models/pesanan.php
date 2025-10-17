<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'layanan',
        'total_harga',
        'status',
        'tanggal_pesanan',
    ];
}
