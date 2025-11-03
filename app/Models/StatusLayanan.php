<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLayanan extends Model
{
    use HasFactory;

    protected $table = 'status_layanan'; // sesuaikan dengan nama tabel kamu di database
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'service_name',
        'technician_name',
        'status',
        'total_amount',
        'created_at'
    ];
}
