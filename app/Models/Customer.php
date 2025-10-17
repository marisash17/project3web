<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; // pastikan sesuai dengan nama tabel di database kamu

    protected $fillable = [
        'nama',
        'alamat',
        'no_telepon',
        'jenis_kelamin',
        'email',
    ];
}
