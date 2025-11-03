<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans'; // nama tabel di database
    protected $fillable = [
        'jenis_layanan',
        'gambar',
        'deskripsi',
        'harga',
    ];
}

