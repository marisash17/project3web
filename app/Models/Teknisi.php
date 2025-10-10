<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'jenis_kelamin',
        'telepon',
        'keahlian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
